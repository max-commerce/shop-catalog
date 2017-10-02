<?php

namespace maxcom\catalog\widgets;

use yii\base\Widget;

class ProductsListWidget extends Widget
{

    public $dataProvider;

    public function run()
    {
        return $this->render('products_list', [
            'dataProvider' => $this->dataProvider
        ]);
    }

}