<?php

    class Date {
        static function getDateBefore(string $before, string $format) : string {
            $date = date($format);
            return date($format, strtotime("{$date} -{$before}"));
        }
    }