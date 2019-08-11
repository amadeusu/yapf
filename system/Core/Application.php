<?php

namespace System\Core;

use System\Core\Response;
use System\Core\Registry;
use System\Core\Router;
use System\Core\Request;
use System\Core\Environment;
use System\Core\DI;
use System\Core\Controller;
use System\Exception\CoreException;

class Application {
    /**
     * @var Benchmark
     */
    public $benchmark;

    /**
     * @var DI
     */
    public $di;

    /**
     * @var string
     */
    public $environment;

    /**
     * @var Asset
     */
    public $assets;

    /**
     * @var Registry
     */
    public $config;

    /**
     * @var Response
     */
    public $response;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var Router
     */
    public $router;

    /**
     * @param array $config
     */
    public function run($config = []) {
        $this->benchmark = new Benchmark();
        $this->environment = Environment::get();
        $this->config = new Registry($config);
        $this->setDependency();
        $this->setParams();
        $this->response = new Response();
        $this->request = new Request();
        $this->assets = new Asset();
        $this->router = new Router($this->config->routes);
        $this->execute();
    }

    public function execute() {
        $controllerName = $this->router->getControllerName();
        try {
            $controllerClass = '\\' . $this->config->name . '\Controllers\\' . $controllerName . 'Controller';
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass;
                if ($controllerClass instanceof Controller) {
                    $controller->setApplication($this)->run();
                }
            } else {
                throw new CoreException('Controller "' . $controllerName . '" not exists: ' . $_SERVER["REQUEST_URI"]);
            }
        } catch (CoreException $e) {
            $e->logError();
            $this->response->setHeader("HTTP/1.1 404 Not Found");
            $this->router->error404();
            $this->execute();
            exit();
        }

        $this->response->sendHeaders();
        echo $this->response->getContent();
    }

    protected function setParams() {
        define('APP_NAME', $this->config->name);

        define('DB_HOST', $this->config->db[$this->environment]['host']);
        define('DB_DBNAME', $this->config->db[$this->environment]['dbname']);
        define('DB_USERNAME', $this->config->db[$this->environment]['username']);
        define('DB_PASSWORD', $this->config->db[$this->environment]['password']);
    }

    protected function setDependency() {
        $this->di = new DI();

        $this->di->set('auth', function () {
            return new \System\Core\Auth(new \Common\Models\User());
        });
    }
}
