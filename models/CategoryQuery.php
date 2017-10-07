<?php

namespace maxcom\catalog\models;
use yii\db\ActiveQuery;
use yii;

class CategoryQuery extends ActiveQuery
{

    public function init()
    {
        parent::init();

        // maxcommerce v.1 implementation
        if (Yii::$app->category->hasAttribute('sort')) {
            $this->orderBy('sort');
        }

        $this->andWhere(['status' => 1]);
    }

	public function roots()
    {
        // maxcommerce v.1 implementation
        if (Yii::$app->category->hasAttribute('parent_id')) {
            $this->andWhere(['or', ['parent_id' => null], ['parent_id' => 0]]);
        }

        // nested sets implementation
        if (Yii::$app->category->hasAttribute('depth')) {
            $this->andWhere(['depth' => 1]);
        }

        return $this;
    }
}