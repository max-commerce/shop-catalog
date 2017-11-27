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
        $query = 'SELECT DISTINCT brand_id FROM shop_products WHERE status = 1 AND category_id = :category_id';
        $params = [':category_id' => $category->id];
        if ($child_categories = $category->childs) {
            $child_categories_ids = ArrayHelper::getColumn($child_categories, 'id');
            $query .= ' OR category_id IN (' . implode(', ', $child_categories_ids) . ')';
        }
        $brand_ids = Yii::$app->db->createCommand($query, $params)->queryColumn();
        $this->andWhere(['id' => $brand_ids]);
        return $this;
    }
}