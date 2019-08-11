<?php

namespace System\Core;

class Url {
    public static function splitUrl($url) {
        return preg_split("/\//", $url, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function cropUrl($url) {
        $uri = explode('?', $url);
        return urldecode($uri[0]);
    }
}