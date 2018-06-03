<?php

namespace maxcom\catalog\models;

use Yii;

class CategoryQuery extends \yii\db\ActiveQuery
{
    /**
     *  @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (Yii::$app->shop_categories->hasAttribute('sort')) {
            // maxcommerce v.1 implementation
            $this->orderBy('sort');
        }
        $this->andWhere(['status' => 1]);
    }

    /**
     *  Метод возвращает ActiveQuery популярных категорий
     *
     *  @return yii\db\ActiveQuery
     */
    public function featured()
    {
        return $this->roots();
    }

    /**
     *  Метод возвращает ActiveQuery категорий верхнего уровня
     *
     *  @return yii\db\ActiveQuery
     */
	public function roots()
    {
        if (Yii::$app->shop_categories->hasAttribute('parent_id')) {
            // maxcommerce v.1 implementation
            $this->andWhere(['or', ['parent_id' => null], ['parent_id' => 0]]);
        } elseif (Yii::$app->shop_categories->hasAttribute('depth')) {
            // nested sets implementation
            $this->andWhere(['depth' => 1]);
        }
        return $this;
    }
}
