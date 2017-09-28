<?php

namespace maxcom\catalog\widgets;

use yii\base\Widget;

class ProductsSliderWidget extends Widget
{

  public function run() {
    return $this->render('products_slider');
  }

}