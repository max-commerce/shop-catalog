<?php

namespace maxcom\catalog\models;
use yii\helpers\Url;
use yii;

class Brand extends \yii\db\ActiveRecord
{

	public static function tableName()
    {
        return 'shop_brand';
    }

    public function getUrl(){
        
        $urlParams = ['/catalog/brand'];

        if ($this->hasAttribute('alias') && !empty($this->alias)) {
            $urlParams['alias'] = mb_strtolower($this->alias, 'utf-8');
        } else {
            $urlParams['id'] = $this->id;
        }

        return Url::to($urlParams);
    }

    public static function find(){
        return new BrandQuery(get_called_class());
    }

}