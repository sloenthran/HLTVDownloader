<?php

    $number = 0;

    foreach($server as $key) {
        $menu .= '<li>
                    <a href="?page=server&id='.$number.'"><i class="fa fa-star left-icon lblue"></i>
                        <span class="right-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
                        <h5>'.$key['name'].'</h5>
                        <div class="clearfix"></div>
                    </a>
                </li>';
        $number++;
    }

    $countFileAndSize = File::countFileAndFileSize('./files');

    $view = new View('index');
    $view->add("menu", $menu);
    $view->add("back", "index.php");
    $view->add("header", "HLTV Downloader");
    $view->add("fileSize", "The archive has {$countFileAndSize[1]} demos ({$countFileAndSize[0]})");