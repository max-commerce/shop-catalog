<?php

namespace maxcom\catalog\models;
use yii\db\ActiveQuery;
use yii;

class ProductQuery extends ActiveQuery
{

	public function active()
    {
        $this->andWhere(['status' => 1]);
        return $this;
    }

    public function byCategory($category_id)
    {
        $this->andWhere(['category_id' => $category_id]);
        return $this;
    }

    public function byCategoryWithChilds($category_id)
    {
        
        $tableName = Yii::$app->category->tableName();

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

        // сама запрашиваемая категория
        $result = [$category_id];

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

        $this->andWhere(['in', 'category_id', $result]);
        return $this;
    }
}