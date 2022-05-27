<?php

namespace app\models;

abstract class Model
{

    protected $props;

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->props) || $name == 'id') {
            $this->props[$name] = true;
            $this->$name = $value;
        }
        return null;
    }

    public function &__get($name)
    {
        if (array_key_exists($name, $this->props) || $name == 'props' || $name == 'id') {
            return $this->$name;
        }
        return null;
    }

    public function __isset($name)
    {
        return $this->__get($name);
    }
}