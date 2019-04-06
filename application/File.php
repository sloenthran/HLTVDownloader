<?php

    class File {
        static function getFileList(string $directory) : array {
            $dir = opendir($directory);

            $filesList = array();

            while($read = readdir($dir)) {

                if($read == '.' || $read == '..') {
                    continue;
                } else {
                    $info = pathinfo($read);
                    $filesList[] = $info['filename'];
                }
            }

            arsort($filesList);

            return $filesList;
        }

        static function getFilesInSpecificPrefix(string $directory, string $prefix, string $delimiter) : array {
            $filesList = File::getFileList($directory);

            $newFilesList = array();

            foreach($filesList as $key => $value) {
                $cachePrefix = explode($delimiter, $value);
                if($cachePrefix[0] == $prefix) {
                    $newFilesList[] = $value;
                }
            }

            arsort($newFilesList);

            return $newFilesList;
        }

        static function fileSizeConvert(float $size) : ?string {
            $size = floatval($size);

            $data = array(
                0 => array(
                    "UNIT" => "TB",
                    "VALUE" => pow(1024, 4)
                ),
                1 => array(
                    "UNIT" => "GB",
                    "VALUE" => pow(1024, 3)
                ),
                2 => array(
                    "UNIT" => "MB",
                    "VALUE" => pow(1024, 2)
                ),
                3 => array(
                    "UNIT" => "KB",
                    "VALUE" => 1024
                ),
                4 => array(
                    "UNIT" => "B",
                    "VALUE" => 1
                ),
            );

            $return = null;

            foreach($data as $key) {
                if($size >= $key['VALUE']) {
                    $return = $size / $key['VALUE'];
                    $return = str_replace(".", "," , strval(round($return, 2)))." ".$key["UNIT"];
                    break;
                }
            }

            return $return;
        }

        static function countFileAndFileSize(string $directory) : array {
            $fileList = File::getFileList($directory);
            $returnArray = array(0, 0);

            foreach($fileList as $file) {
                $returnArray[0] += filesize($directory.'/'.$file.'.zip');
                $returnArray[1]++;
            }

            $returnArray[0] = File::fileSizeConvert($returnArray[0]);

            return $returnArray;
        }

        static function countFileAndSizeInSpecificPrefix(string $directory, string $prefix, string $delimiter) : array {
            $fileList = File::getFilesInSpecificPrefix($directory, $prefix, $delimiter);
            $returnArray = array(0, 0);

            foreach($fileList as $file) {
                $returnArray[0] += filesize($directory.'/'.$file.'.zip');
                $returnArray[1]++;
            }

            $returnArray[0] = File::fileSizeConvert($returnArray[0]);

            return $returnArray;
        }
    }