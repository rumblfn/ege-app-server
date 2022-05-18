<?php

namespace app\controllers;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';

    public function runAction($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die("action not exist");
        }
    }
}