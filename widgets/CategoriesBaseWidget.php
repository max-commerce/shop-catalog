<?php

namespace maxcom\catalog\widgets;

use Yii;
use yii\base\Widget;

class CategoriesBaseWidget extends Widget
{

  public $category;

  public $items;

  public function init() {
    
    if (empty($this->category)) {
      $this->category = Yii::$app->category;
    }

    $categories = $this->category->id ? $this->category->childs : $this->category->find()->active()->roots()->all();

    foreach ($categories as $category) {
      $this->items[] = [
        'label' => $category->title,
        'url' => $category->url
      ];
    }

  }

}