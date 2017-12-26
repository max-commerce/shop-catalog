<?php

namespace maxcom\catalog\models;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii;

class ProductTypeQuery extends ActiveQuery
{
	public function byCategory($category)
    {
        $query = 'SELECT DISTINCT product_type_id FROM shop_products WHERE status = 1';
        if ($child_categories = $category->childs) {
            // TODO сейчас берется список дочерних категорий только 1 уровня, надо брать все
            $child_categories_ids = ArrayHelper::getColumn($child_categories, 'id');
            $query .= ' AND (category_id = :category_id OR category_id IN (' . implode(', ', $child_categories_ids) . '))';
        } else {
            $query .= ' AND category_id = :category_id';
        }
        $params = [':category_id' => $category->id];
        $type_ids = Yii::$app->db->createCommand($query, $params)->queryColumn();
        $this->andWhere(['id' => $type_ids]);
        return $this;
    }
}