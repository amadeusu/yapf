<?php

namespace System\Core;

class Config {
    /**
     * @var Config
     */
    private static $instance = null;

    /**
     * Returns instance of config
     *
     * @param array $config
     * @return array
     */
    public static function getInstance($config = []) {
       if (isset(self::$instance)) {
           self::$instance = $config;
       }
       return self::$instance;
    }

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public function __wakeup()
    {
    }
}
