<?php

namespace maxcom\catalog\widgets;

use yii\base\Widget;

class ProductsFilterWidget extends Widget
{

    public $category;

    public function run() {

        return $this->render('products_filter', [
            'category' => $this->category
        ]);

    }

}