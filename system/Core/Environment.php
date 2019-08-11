<?php

namespace System\Core;

class Environment {
    /**
     * @return string
     */
    public static function get() {
        $environment = 'development';
        if ($_SERVER['SERVER_ADDR'] != '127.0.0.1') {
            $environment = 'production';
        }
        return $environment;
    }
}