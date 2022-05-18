<?php

namespace app\models\repositories;

use app\models\entities\Subject;
use app\models\Repository;

class SubjectRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'subjects';
    }

    protected function getEntityClass(): string
    {
        return Subject::class;
    }
}