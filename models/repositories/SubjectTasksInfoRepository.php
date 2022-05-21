<?php

namespace app\models\repositories;

use app\models\entities\SubjectTasksInfo;
use app\models\Repository;

class SubjectTasksInfoRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'subject_tasks_info';
    }

    protected function getEntityClass(): string
    {
        return SubjectTasksInfo::class;
    }
}