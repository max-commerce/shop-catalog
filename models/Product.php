<?php

namespace maxcom\catalog\models;
use yii\helpers\Url;
use yii;

class Product extends \yii\db\ActiveRecord implements \maxcom\core\interfaces\CatalogProductInterface
{
	public static function tableName()
    {
        return 'shop_products';
    }

    public function getId(){
    	return $this->product_id;
    }

    public function getStatus(){
        // ...
    }

    public function getUrl(){
    	return $this->alias ? Url::to(['/catalog/' . mb_strtolower($this->alias, 'utf-8')]) : Url::to(['/catalog/product', 'id' => $this->id]);
    }

    public function getAlias(){
        return null;
    }

    public function getCategory(){
    	return $this->category_id ? Yii::$app->category->findOne($this->category_id) : null;
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