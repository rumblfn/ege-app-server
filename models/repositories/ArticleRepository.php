<?php

namespace app\models\repositories;

use app\models\entities\Article;
use app\models\Repository;
use app\engine\App;

class ArticleRepository extends Repository
{
    public function getAllWhereAndWhere($name, $value, $name2, $value2) {
        $tableName = $this->getTableName();

        $new_article = new Article();
        $props = 'id, ';
        foreach($new_article->props as $props_name => $props_value) {
            if ($props_name !== 'actions') {
                $props .= $props_name . ', ';
            }
        }
        
        $props = substr($props, 0, -2);

        $sql = "SELECT $props FROM `{$tableName}` where $name = :$name AND $name2 = :$name2";
        return App::call()->db->queryAll($sql, [
            $name => $value, $name2 => $value2
        ], $this->getEntityClass());
    }

    protected function getTableName(): string
    {
        return 'articles';
    }

    protected function getEntityClass(): string
    {
        return Article::class;
    }
}