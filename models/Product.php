<?php

namespace maxcom\catalog\models;
use yii\helpers\Url;
use yii;

class Product extends \yii\db\ActiveRecord implements \maxcom\core\interfaces\CatalogProductInterface
{
    /**
    *
    */
    const EVENT_VIEWED = 'viewed';

	public static function tableName()
    {
        return 'shop_products';
    }

    public function getId(){
    	return $this->primaryKey;
    }

    public function getStatus(){
        // ...
    }

    public function getTitle(){
        return $this->name;
    }

    public function getUrl(){
    	return $this->alias ? Url::to(['/catalog/' . mb_strtolower($this->alias, 'utf-8')]) : Url::to(['/catalog/product', 'id' => $this->id]);
    }

    public function getAlias(){
        return null;
    }

    public function getCategory(){
        return $this->hasOne(Yii::$app->category->className(), ['category_id' => 'category_id']);
    }

    public function getBrand(){
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    public function getSimilarProducts($limit = null){
        return Product::find()
                ->where(['=', 'category_id', $this->category_id])
                ->andWhere(['!=', 'product_id', $this->id])
                ->limit($limit);
    }

    public static function find(){
    	return new ProductQuery(get_called_class());
    }

    public function attributeLabels(){
    	return [
    		'price' => 'Цена',
    		'title' => 'Наименование'
    	];
    }
}