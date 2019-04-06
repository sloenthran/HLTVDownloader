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

            $menu .= '<li>
                    <a href="'.getUrl().'files/'.$file.'.zip"><i class="fa fa-cloud-download left-icon lblue"></i>
                        <span class="right-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
                        <h5>'.$map[0].'</h5>
                        <span class="sub-text"><i>'.$date->format("H:i d.m.Y").'</i> :: '.File::fileSizeConvert(filesize("./files/{$file}.zip")).'</span>
                        <div class="clearfix"></div>
                    </a>
                </li>';
        }

    }

    $view = new View('index');
    $view->add('menu', $menu);
    $view->add('back', 'index.php?page=server&id='.$id.'');
    $view->add('header',$server[$id]['name']. ' :: '. DateTime::createFromFormat("ymd", $idTwo)->format("d.m.Y"));
    $view->add('fileSize', '');