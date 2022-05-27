<?php
namespace app\models\entities;


use app\models\Model;

class TaskTheory extends Model
{
    protected $id;
    protected $user_id;
    protected $subject_id;
    protected $task_id;
    protected $body;
    protected $time;

    protected $props = [
        'subject_id' => false,
        'task_id' => false,
        'body' => false,
        'time' => false,
        'user_id' => false
    ];


    public function __construct($user_id = null, $subject_id = null, $task_id = null, $body = null, $time = null)
    {
        $this->subject_id = $subject_id;
        $this->subjectask_idt_id = $task_id;
        $this->body = $body;
        $this->time = $time;
        $this->user_id = $user_id;
    }
}