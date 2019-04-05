<?php

    $number = 0;

    foreach($server as $key) {
        $menu .= '<li><a href="?page=server&id='.$number.'"> '.$key['name'].'</a></li>';
        $number++;
    }

    $view = new View('index');
    $view->add("menu", $menu);