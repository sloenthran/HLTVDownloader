<?php

    class Text {
        static function clearText(?string $text) : ?string {
            if(get_magic_quotes_gpc())
            {

                $text = stripslashes($text);

            }

            $text = trim($text);
            $text = htmlspecialchars($text);
            $text = htmlentities($text);
            $text = strip_tags($text);

            return $text;
        }
    }