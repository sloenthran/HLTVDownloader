<?php

    function ClassLoader($className) {
        require_once("./application/{$className}.php");
    }

    spl_autoload_register('ClassLoader');