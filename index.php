<?php

    error_reporting(0);

    ob_start();

        require_once ('config.php');
        require_once('./application/ClassLoader.php');

        $page = Text::clearText($_GET['page']);
        $page = str_replace("/", "", $page);

        if($page == '') { $page = 'index'; }

        if(file_exists("./model/{$page}.php")) {
            require_once("./model/{$page}.php");
        }

    ob_end_flush();