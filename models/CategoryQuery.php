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
        $modelClass = $this->modelClass;
        if (array_key_exists('sort', $modelClass::getTableSchema()->columns)) {
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
        $modelClass = $this->modelClass;
        if (array_key_exists('parent_id', $modelClass::getTableSchema()->columns)) {
            // maxcommerce v.1 implementation
            $this->andWhere(['or', ['parent_id' => null], ['parent_id' => 0]]);
        } elseif (array_key_exists('depth', $modelClass::getTableSchema()->columns)) {
            // nested sets implementation
            $this->andWhere(['depth' => 1]);
        }
        return $this;
    }
}
