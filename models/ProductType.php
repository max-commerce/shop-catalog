<?php

namespace maxcom\catalog\models;
use Yii;

class ProductType extends \yii\db\ActiveRecord
{
	public static function tableName()
    {
        return 'shop_product_type';
    }

    public static function find(){
        return new ProductTypeQuery(get_called_class());
    }
}