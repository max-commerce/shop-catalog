<?php

namespace maxcom\catalog\widgets;

use yii\base\Widget;

class ProductsGridWidget extends Widget
{

    public $dataProvider;

    public function run()
    {
        return $this->render('products_grid', [
            'dataProvider' => $this->dataProvider
        ]);
    }

}