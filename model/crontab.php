<?php

    foreach($server as $key) {
        $ftp = new FTP($key['host'], $key['user'], $key['pass']);

        $fileList = $ftp->getFilesInDirectory($key['directory'], '*.dem');
        natcasesort($fileList);

        $count = count($fileList);

        if($count > 1) {
            foreach($fileList as $file) {
                if($count > 1) {
                    $fileName = str_replace("{$key['directory']}hltv-", '', $file);
                    $ftp->downloadFile("{$key['prefix']}_{$fileName}", 'cache/', $file);
                    ZIP::archive("{$key['prefix']}_{$fileName}");
                }

                $count--;
            }
        }

        $fileList = File::getFileList("./files");


    }