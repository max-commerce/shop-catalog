<?php

namespace maxcom\catalog\models;
use yii\db\ActiveQuery;
use yii;

class ProductQuery extends ActiveQuery
{

    public function init()
    {
        parent::init();
        $this->andWhere(['status' => 1]);
    }

    public function byCategory($category_id)
    {
        $this->andWhere(['category_id' => $category_id]);
        return $this;
    }

    public function withFilter($filter)
    {
        unset($filter['category']);
        unset($filter['price']);
        unset($filter['id']);
        unset($filter['page']);
        $this->andWhere($filter);
        return $this;
    }

    public function byCategoryWithChilds($category_id)
    {
        
        $tableName = Yii::$app->category->tableName();

        // сама запрашиваемая категория
        $result = [$category_id];

        // дочерние категории
        $rows = [];

        // maxcommerce v.1 implementation
        if (Yii::$app->category->hasAttribute('category_id') && Yii::$app->category->hasAttribute('parent_id')) {
            $sql = "SELECT t2.category_id as lev2, 
                           t3.category_id as lev3,
                           t4.category_id as lev4,
                           t5.category_id as lev5
                    FROM `{$tableName}` AS t1
                        LEFT JOIN {$tableName} AS t2 ON t2.parent_id = t1.category_id
                        LEFT JOIN {$tableName} AS t3 ON t3.parent_id = t2.category_id
                        LEFT JOIN {$tableName} AS t4 ON t4.parent_id = t3.category_id
                        LEFT JOIN {$tableName} AS t5 ON t5.parent_id = t4.category_id
                    WHERE t1.category_id = :category_id";
            
            $rows = Yii::$app->db->createCommand($sql)
                ->bindValue(':category_id', $category_id)
                ->queryAll();

        }

        // maxcommerce v.2 nested sets implementation
        if (Yii::$app->category->hasAttribute('tree') && Yii::$app->category->hasAttribute('depth')) {

            $category = Yii::$app->category->findOne($category_id);
            // TODO: плохо что передается category_id а не объект категории,
            // лучше переделать на передачу объекта, чтобы не делать лишний запрос

            $sql = "SELECT id 
                    FROM {$tableName} WHERE `lft` > :lft AND `rgt` < :rgt";

            $command = Yii::$app->db->createCommand($sql)
                    ->bindValue(':lft', $category->lft)
                    ->bindValue(':rgt', $category->rgt);

            $rows = $command->queryAll();
        }

        if ($rows) {
            // дочерние категории в соответвтсии с выбранным depth
            foreach ($rows as $row) {
                $result = array_merge($result, array_values($row));
            }

            // удаляем дубликаты
            $result = array_unique($result);

            // удаляем пустые значения
            $result = array_filter($result);

            // приводим значения к int иначе имеем такое `category_id` IN (9, '50', '51', ...)
            $result = array_map(function($el){
            return (int)$el;
            }, $result);
        }

        $this->andWhere(['in', 'category_id', $result]);
        return $this;
    }
}