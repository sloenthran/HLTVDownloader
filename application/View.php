<?php

class View
{
    private $tagList = array();
    private $htmlBody;

    function __construct($fileName) {
        $file = fopen("./view/{$fileName}.html", "r");
        $this->htmlBody = fread($file, filesize("./view/{$fileName}.html"));
        fclose($file);
    }

    function add($tag, $value) {
        $this->tagList["{{$tag}}"] = $value;
    }

    function __destruct() {
        foreach($this->tagList as $tag => $value) {
            $this->htmlBody = str_replace($tag, $value, $this->htmlBody);
        }

        echo $this->htmlBody;
    }
}