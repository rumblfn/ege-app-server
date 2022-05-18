<?php

namespace app\controllers;

use app\engine\App;

class SubjectController extends Controller
{
    public function actionIndex()
    {
        $answer = [
            'name' => 'subject',
            'getAll' => 'get all subjects'
        ];
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function actionGetSubjects()
    {
        $subjects = App::call()->subjectRepository->getAll();
        echo json_encode($subjects, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}