<?php

namespace maxcom\catalog\models;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii;

class Category extends \yii\db\ActiveRecord implements \maxcom\core\interfaces\CatalogCategoryInterface
{

	public static function tableName()
    {
        return 'shop_category';
    }

    public function getId(){
    	return $this->category_id;
    }

    public function getTitle(){
        return $this->name;
    }

    public function getStatus(){
        // ...
    }

    public function getUrl(){
        
        $urlParams = ['/catalog/category'];

        if ($this->hasAttribute('alias') && !empty($this->alias)) {
            $urlParams['alias'] = mb_strtolower($this->alias, 'utf-8');
        } else {
            $urlParams['id'] = $this->id;
        }

        return Url::to($urlParams);
    }

    public function getChilds()
    {
        if (Yii::$app->category->hasAttribute('category_id') && Yii::$app->category->hasAttribute('parent_id')) {
            
            // maxcommerce v.1 implementation
            return $this->hasMany(self::className(), ['parent_id' => 'category_id']);

        } else {

            // maxcommerce v.2 implementation
            $sql = "SELECT * FROM " . self::tableName() . " WHERE `lft` > :lft AND `rgt` < :rgt AND depth = :depth + 1";

            $params = [':lft' => $this->lft, ':rgt' => $this->rgt, ':depth' => $this->depth];

            return $this->findBySql($sql, $params)->all();
        }
    }

    public function getParent()
    {
        if (Yii::$app->category->hasAttribute('category_id') && Yii::$app->category->hasAttribute('parent_id')) {
            
            // maxcommerce v.1 implementation
            return $this->hasOne(self::className(), ['category_id' => 'parent_id']);

        } else {

            // maxcommerce v.2 implementation
            $sql = "SELECT * FROM " . self::tableName() . " WHERE `lft` > :id AND `rgt` < :id AND depth = :depth - 1";

            $params = [':id' => $this->id, ':depth' => $this->depth];

            return $this->findBySql($sql, $params)->one();

        }
    }

    /**
    *   Return array id=>title of all models
    */
    public function listAll(){
        return ArrayHelper::map(self::find()->all(), 'category_id', 'title');
    }

    public static function find(){
    	return new CategoryQuery(get_called_class());
    }

}