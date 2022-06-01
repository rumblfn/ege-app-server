<?php
namespace app\models\entities;


use app\models\Model;

class Article extends Model
{
    protected $id;
    protected $user_id;
    protected $title;
    protected $type;
    protected $views;
    protected $starred;
    protected $actions;
    protected $subject_id;
    protected $task_id;

    public $props = [
        'title' => false,
        'type' => false,
        'views' => false,
        'starred' => false,
        'actions' => false,
        'user_id' => false,
        'subject_id' => false,
        'task_id' => false
    ];


    public function __construct(
        $user_id = null,
        $title = null,
        $type = null,
        $views = null,
        $starred = null,
        $actions = null,
        $subject_id = null,
        $task_id = null
    ) {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->type = $type;
        $this->views = $views;
        $this->starred = $starred;
        $this->actions = $actions;
        $this->subject_id = $subject_id;
        $this->task_id = $task_id;
    }
}