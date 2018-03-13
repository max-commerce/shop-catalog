<?php

namespace maxcom\catalog\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii;

class BrandQuery extends ActiveQuery
{

    public function init()
    {
        parent::init();
        $this->orderBy('title');
    }

	public function byCategory($category)
    {
        $query = 'SELECT DISTINCT brand_id FROM shop_products WHERE brand_id <> 0 AND status = 1';
        if ($child_categories = $category->childs) {
            // TODO сейчас берется список дочерних категорий только 1 уровня, надо брать все
            $child_categories_ids = ArrayHelper::getColumn($child_categories, 'id');
            $query .= ' AND (category_id = :category_id OR category_id IN (' . implode(', ', $child_categories_ids) . '))';
        } else {
            $query .= ' AND category_id = :category_id';
        }
        $params = [':category_id' => $category->id];
        $brand_ids = Yii::$app->db->createCommand($query, $params)->queryColumn();
        $this->andWhere(['id' => $brand_ids]);
        return $this;
    }

    /**
    *   Возвращает "популярные" бренды
    */
    public function featured()
    {
        return $this;
    }
}
