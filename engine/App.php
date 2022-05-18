<?php

namespace app\engine;

use app\traits\TSingletone;


class App
{
    use TSingletone;

    public $config;
    private $components;
    private $controller;
    private $action;

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    protected function runController() {
        $this->controller = $this->request->getControllerName() ?: 'subject';
        $this->action = $this->request->getActionName();
        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            $controller->runAction($this->action);
        } else {
            echo "404";
        }
    }

    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);

                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            } else {
                Die("Нет класса компонента");
            }
        } else {
            Die("Нет такого компонента");
        }
    }

    public static function call()
    {
        return static::getInstance();
    }

    public function __get($name)
    {
        return $this->components->get($name);
    }
}