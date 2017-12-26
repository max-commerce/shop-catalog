<?php

namespace maxcom\catalog\widgets;

use Yii;
use yii\base\Widget;

class ProductsFilterWidget extends Widget
{

    public $category;

    public function run() {

        return $this->render('products_filter', [
            'category' => $this->category,
            'brands' => \maxcom\catalog\models\Brand::find()->byCategory($this->category)->all(),
            'brands_checked' => Yii::$app->request->get('brand_id') ? array_values(Yii::$app->request->get('brand_id')) : [],
            'types' => \maxcom\catalog\models\ProductType::find()->byCategory($this->category)->all(),
            'types_checked' => Yii::$app->request->get('product_type_id') ? array_values(Yii::$app->request->get('product_type_id')) : [],
        ]);

    }

}