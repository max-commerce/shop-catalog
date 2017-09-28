<?php

namespace maxcom\catalog\models;
use yii\helpers\Url;

class Category extends \yii\db\ActiveRecord implements \maxcom\core\interfaces\CatalogCategoryInterface
{

	public static function tableName()
    {
        return 'shop_category';
    }

    public function getId(){
    	return $this->category_id;
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
        return $this->hasMany(self::className(), ['parent_id' => 'category_id']);
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['category_id' => 'parent_id']);
    }

    public static function find(){
    	return new CategoryQuery(get_called_class());
    }

}