<?php

namespace app\controllers;

use app\engine\App;
use app\models\entities\Article;

class ArticlesController extends Controller
{
    public function actionAddArticle()
    {
        $login = App::call()->request->getParams()['login'];
        $actions = App::call()->request->getParams()['actions'];
        $title = App::call()->request->getParams()['title'];
        $subjectId = App::call()->request->getParams()['subject_id'];
        $taskNumber = App::call()->request->getParams()['task_id'];
        $type = App::call()->request->getParams()['type'];
        $user = App::call()->userRepository->getWhere('login', $login);

        $article = new Article(
            $user->id, $title, $type, 0, 0, $actions, $subjectId, $taskNumber
        );
        App::call()->articleRepository->insert($article);

        $user->karma = (int)$user->karma + 7;
        App::call()->userRepository->save($user);

        $answer = [
            'user_id' => $user->id,
            'article_id' => $article->id,
            'status' => true
        ];
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function actionGetArticle()
    {
        $article_id = App::call()->request->getParams()['id'];
        $article = App::call()->articleRepository->getAllWhere('id', $article_id);
        echo json_encode($article[0], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function actionGetArticles()
    {
        $type = App::call()->request->getParams()['type'];
        $login = App::call()->request->getParams()['login'];
        $user = App::call()->userRepository->getWhere('login', $login);
        $articles = App::call()->articleRepository->getAllWhereAndWhere('type', $type, 'user_id', $user->id);

        $answer = [
            'body' => $articles,
            'status' => true
        ];
        echo json_encode($answer);
    }
}