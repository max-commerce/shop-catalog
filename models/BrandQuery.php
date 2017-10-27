<?php

namespace maxcom\catalog\models;
use yii\db\ActiveQuery;
use yii;

class BrandQuery extends ActiveQuery
{

    public function init()
    {
        parent::init();
        $this->orderBy('title');
    }

	public function byCategory($category_id)
    {
        $brand_ids = Yii::$app->db->createCommand('SELECT DISTINCT brand_id FROM shop_products WHERE status = 1 AND category_id = :category_id', [':category_id' => $category_id])->queryColumn();
        $this->andWhere(['id' => $brand_ids]);
        return $this;
    }
}