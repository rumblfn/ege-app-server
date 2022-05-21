<?php
namespace app\models\entities;


use app\models\Model;

class SubjectTasksInfo extends Model
{
    protected $id;
    protected $subject_id;
    protected $task_number;
    protected $title;
    protected $description;
    protected $complexity;

    protected $props = [
        'subject_id' => false,
        'task_number' => false,
        'title' => false,
        'description' => false,
        'complexity' => false,
    ];


    public function __construct($subject_id = null, $task_number = null, $title = null, $description = null, $complexity = null)
    {
        $this->subject_id = $subject_id;
        $this->task_number = $task_number;
        $this->title = $title;
        $this->description = $description;
        $this->complexity = $complexity;
    }
}