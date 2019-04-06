<?php

    $id = Text::clearText($_GET['id']);

    $menu .= "<li>
            <a href='index.php?page=server_demos&id={$id}'><i class=\"fa fa-calendar left-icon lblue\"></i>
                        <span class=\"right-icon\"><i class=\"fa fa-arrow-circle-o-right\"></i></span>
                        <h5>".date("d.m.Y")."</h5>
                        <div class=\"clearfix\"></div>
                    </a>
              </li>";

    for($i = 1; $i < 7; $i++) {
        $menu .= "<li>
            <a href='index.php?page=server_demos&id={$id}&date=".Date::getDateBefore("{$i} day", "ymd")."'><i class=\"fa fa-calendar left-icon lblue\"></i>
                        <span class=\"right-icon\"><i class=\"fa fa-arrow-circle-o-right\"></i></span>
                        <h5>".Date::getDateBefore("{$i} day", "d.m.Y")."</h5>
                        <div class=\"clearfix\"></div>
                    </a>
              </li>";
    }

    $countFileAndSize = File::countFileAndSizeInSpecificPrefix('./files', $server[$id]['prefix'], "_");

    $view = new View('index');
    $view->add('menu', $menu);
    $view->add('back', 'index.php');
    $view->add('header', $server[$id]['name']);
    $view->add("fileSize", "This server archive has {$countFileAndSize[1]} demos ({$countFileAndSize[0]})");