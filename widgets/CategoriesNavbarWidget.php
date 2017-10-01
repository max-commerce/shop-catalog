<?php

namespace maxcom\catalog\widgets;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

class CategoriesNavbarWidget extends CategoriesBaseWidget
{

  public $countVisible = null;

  public function run() {

    if ($this->items) {
      
      NavBar::begin([
        'options' => [
            'class' => 'navbar-default navbar-categories',
        ],
      ]);

      if (!is_null($this->countVisible) && $this->countVisible < count($this->items)) {
        $items = array_slice($this->items, 0, $this->countVisible);
        $items[] = [
            'label' => 'Еще..',
            'items' => array_slice($this->items, $this->countVisible),
        ];
      } else {
        $items = $this->items;
      }

      echo Nav::widget([
          'options' => ['class' => 'navbar-nav'],
          'items' => $items,
      ]);

      NavBar::end();

    }
  }

}