<?php

namespace app\interfaces;

interface IRepository
{
    public function getOne($id);
    public function getAll();
}
