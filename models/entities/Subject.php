<?php
namespace app\models\entities;


use app\models\Model;

class Subject extends Model
{
    protected $id;
    protected $title;

    protected $props = [
        'title' => false,
    ];


    public function __construct($title = null)
    {
        $this->title = $title;
    }
}