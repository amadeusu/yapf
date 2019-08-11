<?php

namespace System\Core;

use System\Core\Response;
use System\Core\Url;

class Router {
    /**
     * string
     */
    const DEFAULT_CONTROLLER = 'Index';

    /**
     * string
     */
    const DEFAULT_ACTION = 'index';

    /**
     * @var array
     */
    public $routes = [];

    /**
     * @var array
     */
    public $params = [];

    /**
     * @param array $rotes
     */
    public function __construct($routes = [])
    {
        $this->addRoute($routes);
        $this->dispatch();
    }

    public function addRoute($route, $destination = null) {
        if ($destination != null && !is_array($route)) {
            $route = array($route => $destination);
        }
        $this->routes = array_merge($this->routes, $route);
    }

    /**
     * @param string $requestedUrl
     */
    public function dispatch($requestedUrl = null) {
        if ($requestedUrl === null) {
            $requestedUri = '';
            $requestedUrl = Url::cropUrl($_SERVER['REQUEST_URI']);
            $this->params = Url::splitUrl($requestedUrl);
        }

        if (isset($this->routes[$requestedUrl])) {
            $this->params = Url::splitUrl($this->routes[$requestedUrl]);
            return true;
        }

        foreach ($this->routes as $route => $uri) {
            if (strripos($route, ':') !== false) {
                $route = str_replace(':any', '(.+)', str_replace(':num', '([0-9]+)', $route));
            }
            if (preg_match('#^' . $route . '$#', $requestedUrl)) {
                if (strripos($uri, '$') !== false && strpos($route, '(') !== false) {
                    $uri = preg_replace('#^' . $route . '$#', $uri, $requestedUrl);
                }
                $this->params = Url::splitUrl($uri);
                break;
            }
        }
    }

    /**
     * @return string
     */
    public function getControllerName() {
        $controllerName = isset($this->params[0]) ? $this->params[0] : self::DEFAULT_CONTROLLER;
        $controllerName = ucfirst($controllerName);
        return $controllerName;
    }

    /**
     * @return string
     */
    public function getActionName() {
        $actionName = (isset($this->params[1]) ? $this->params[1] : self::DEFAULT_ACTION) . 'Action';
        return $actionName;
    }

    /**
     * @return array
     */
    public function getActionParams() {
        return array_slice($this->params, 2);
    }

    public function error404() {
        $this->addRoute(Url::cropUrl($_SERVER["REQUEST_URI"]), 'site/error404');
        $this->dispatch();
    }
}