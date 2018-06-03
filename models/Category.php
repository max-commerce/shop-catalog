<?php

namespace maxcom\catalog\models;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class Category extends \yii\db\ActiveRecord
{
	public static function tableName()
    {
        return 'shop_category';
    }

    public function getId()
    {
    	return $this->category_id;
    }

    public function getTitle()
    {
        return $this->name;
    }

    public function getStatus()
    {
        // ...
    }

    public function getUrl()
    {
        $urlParams = ['/catalog/category'];
        if ($this->hasAttribute('alias') && !empty($this->alias)) {
            $urlParams['alias'] = mb_strtolower($this->alias, 'utf-8');
        } else {
            $urlParams['id'] = $this->id;
        }
        return Url::to($urlParams);
    }

    /**
     *  Метод проверяет наличие дочерних категорий
     *
     *  @return bool
     */
    public function hasChilds()
    {
        return $this->childsCount() > 0;
    }

    /**
     *  Метод возвращает количество дочерних категорий
     *
     *  @return int
     */
    public function childsCount()
    {
        return $this->getChilds()->count();
    }

    /**
     *  Метод возвращает ActiveQuery дочерних категорий
     *
     *  @return yii\db\ActiveQuery
     */
    public function getChilds()
    {
        if ($this->hasAttribute('category_id') && $this->hasAttribute('parent_id')) {
            // maxcommerce v.1 implementation
            return $this->hasMany(self::className(), [
                'parent_id' => 'category_id'
            ]);
        } else {
            // maxcommerce v.2 implementation
            return $this->findBySql("SELECT * FROM " . self::tableName() . " WHERE `lft` > :lft AND `rgt` < :rgt AND depth = :depth + 1", [
                ':lft' => $this->lft,
                ':rgt' => $this->rgt,
                ':depth' => $this->depth
            ]);
        }
    }

    /**
     *  Метод возвращает ActiveQuery родительской категории
     *
     *  @return yii\db\ActiveQuery
     */
    public function getParent()
    {
        if ($this->hasAttribute('category_id') && $this->hasAttribute('parent_id')) {
            // maxcommerce v.1 implementation
            return $this->hasOne(self::className(), [
                'category_id' => 'parent_id'
            ]);
        } else {
            // maxcommerce v.2 implementation
            return $this->findBySql("SELECT * FROM " . self::tableName() . " WHERE `lft` > :id AND `rgt` < :id AND depth = :depth - 1", [
                ':id' => $this->id,
                ':depth' => $this->depth
            ]);
        }
    }

    /**
     *  Метод возвращает массив id=>title всех категорий
     *
     *  @return array
     */
    public function listAll()
    {
        return ArrayHelper::map(self::find()->all(), 'category_id', 'title');
    }

    /**
     *  @inheritdoc
     */
    public static function find()
    {
    	return new CategoryQuery(get_called_class());
    }
}
