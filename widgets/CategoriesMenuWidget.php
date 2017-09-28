<?php

namespace maxcom\catalog\widgets;

use yii\widgets\Menu;

class CategoriesMenuWidget extends CategoriesBaseWidget
{

  public function init() {
    parent::init();
    ob_start();
  }

  public function run() {

    $content = ob_get_clean();

    if ($this->items) {
      
      echo $content;

      echo Menu::widget([
          'options' => [
            'class' => 'list-group',
          ],
          'itemOptions' => [
            'class' => 'list-group-item',
          ],
          'items' => $this->items
      ]);
    }
  }

}