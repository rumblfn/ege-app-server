<?php

use app\engine\Db;
use app\engine\Request;
use app\models\repositories\SubjectRepository;

return [
    'root' => dirname(__DIR__),
    'controllers_namespaces' => 'app\\controllers\\',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:8889',
            'login' => 'root',
            'password' => 'root',
            'database' => 'ege',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'subjectRepository' => [
            'class' => SubjectRepository::class
        ]
    ]
];