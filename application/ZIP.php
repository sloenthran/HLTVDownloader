<?php

    class ZIP {
        static function archive(string $fileName) {
            $zip = new ZipArchive();

            $zip->open("./files/{$fileName}.zip", ZIPARCHIVE::CREATE);
            $zip->addFile("./cache/{$fileName}");
            $zip->close();

            unlink("./cache/{$fileName}");
        }
    }