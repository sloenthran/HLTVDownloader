<?php

    function getUrl() : string {
        $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

        $url = str_replace("index.php", "", $_SERVER['PHP_SELF']);
        $url = Text::clearText($url);
        return $protocol.'://'.$_SERVER['HTTP_HOST'].$url;
    }

    $id = Text::clearText($_GET['id']);
    $idTwo = Text::clearText($_GET['date']);

    $tableData = null;

    if($id > count($server) || $id < 0 || $id == '') {
        $id = 0;
    }

    if($idTwo == '') { $idTwo = date("ymd"); }

    $files = File::getFilesInSpecificPrefix("./files", $server[$id]['prefix'], "_");

    foreach($files as $file) {
        $data = explode("-", $file);

        $date = DateTime::createFromFormat("ymdHi", str_replace("{$server[$id]['prefix']}_", "", $data[0]));

        if($date->format("ymd") == $idTwo) {
            $map = explode(".", $data[1]);

            $tableData .= '<tr>'.
                "<td>{$map[0]}</td>".
                "<td>{$date->format("H:i d.m.Y")}</td>".
                "<td><input type=\"text\" value=\"". getUrl() ."files/{$file}.zip\"></td>".
                "<td>". File::fileSizeConvert(filesize("./files/{$file}.zip")) ."</td>".
                "<td><a href=\"". getUrl() ."files/{$file}.zip\">Klik</a></td>".
                '</tr>';
        }

    }

    $menu .= "<li><a href='index.php?page=server&id={$id}'>".date("d.m.Y")."</a>".
        "<li><a href='index.php?page=server&id={$id}&date=".Date::getDateBefore("1 day", "ymd")."'>".Date::getDateBefore("1 day", "d.m.Y")."</a>".
        "<li><a href='index.php?page=server&id={$id}&date=".Date::getDateBefore("2 day", "ymd")."'>".Date::getDateBefore("2 day", "d.m.Y")."</a>".
        "<li><a href='index.php?page=server&id={$id}&date=".Date::getDateBefore("3 day", "ymd")."'>".Date::getDateBefore("3 day", "d.m.Y")."</a>".
        "<li><a href='index.php?page=server&id={$id}&date=".Date::getDateBefore("4 day", "ymd")."'>".Date::getDateBefore("4 day", "d.m.Y")."</a>".
        "<li><a href='index.php?page=server&id={$id}&date=".Date::getDateBefore("5 day", "ymd")."'>".Date::getDateBefore("5 day", "d.m.Y")."</a>".
        "<li><a href='index.php?page=server&id={$id}&date=".Date::getDateBefore("6 day", "ymd")."'>".Date::getDateBefore("6 day", "d.m.Y")."</a>";

    $view = new View('server');
    $view->add('tableData', $tableData);
    $view->add('menu', $menu);