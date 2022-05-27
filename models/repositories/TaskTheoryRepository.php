<?php

namespace app\models\repositories;

use app\models\entities\TaskTheory;
use app\models\Repository;

class TaskTheoryRepository extends Repository
{
    public function getTableName(): string
    {
        return 'tasks_theory';
    }

    protected function getEntityClass(): string
    {
        return TaskTheory::class;
    }
}