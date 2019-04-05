<?php

    class FTP {
        private $host = '';
        private $user = '';
        private $pass = '';

        private $connected = false;
        private $ftp;

        function __construct(string $host, string $user, string $pass) {
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;

            $this->connect();
        }

        function connect() {
            $this->ftp = ftp_connect($this->host);

            if(ftp_login($this->ftp, $this->user, $this->pass)) {
                $this->connected = true;
                return true;
            }

            return false;
        }

        function getFilesInDirectory(string $directory, string $fileName) : array {
            if($this->connected) {
                return ftp_nlist($this->ftp, $directory . $fileName);
            }

            return array();
        }

        function downloadFile(string $fileName, string $saveDirectory, string $remoteFile) {
            if($this->connected) {
                $cacheFile  = fopen("{$saveDirectory}/{$fileName}", "w");

                $download = ftp_fget($this->ftp, $cacheFile, $remoteFile, FTP_BINARY);

                fwrite($cacheFile, $download);
                fclose($cacheFile);
            }
        }

        function removeFile(string $fileName) {
            if($this->connected) {
                ftp_delete($this->ftp, $fileName);
            }
        }

        function __destruct() {
            if($this->connected) {
                $this->connected = false;
                ftp_close($this->ftp);
            }
        }
    }