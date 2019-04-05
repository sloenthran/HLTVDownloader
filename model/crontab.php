<?php

    foreach($server as $key) {
        $ftp = new FTP($key['host'], $key['user'], $key['pass']);

        $filesList = $ftp->getFilesInDirectory($key['directory'], '*.dem');
        natcasesort($filesList);

        $count = count($filesList);

        if($count > 1) {
            foreach($filesList as $file) {
                if($count > 1) {
                    $fileName = str_replace("{$key['directory']}hltv-", '', $file);
                    $ftp->downloadFile("{$key['prefix']}_{$fileName}", 'cache/', $file);
                    ZIP::archive("{$key['prefix']}_{$fileName}");
                    $ftp->removeFile($file);
                }

                $count--;
            }
        }

        $files = File::getFilesInSpecificPrefix("./files", $key['prefix'], "_");

        foreach($files as $file) {
            $data = explode("-", $file);

            $date = DateTime::createFromFormat("ymdHi", str_replace("{$key['prefix']}_", "", $data[0]));

            if($date->format("ymd") <= Date::getDateBefore("7 day", "ymd")) {
                unlink("./files/{$file}.zip");
            }
        }
    }