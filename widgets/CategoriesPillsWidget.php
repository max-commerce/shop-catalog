<?php

namespace maxcom\catalog\widgets;
use yii\bootstrap\Nav;

class CategoriesPillsWidget extends CategoriesBaseWidget
{

  public function run() {
    if ($this->items) {
      echo Nav::widget([
          'options' => ['class' =>'nav-pills'],
          'items' => $this->items
      ]);
    }
  }

}