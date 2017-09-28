<?php

namespace maxcom\catalog\widgets;

use yii\base\Widget;
use yii\grid\GridView;
use yii\helpers\Html;

class ProductsGridWidget extends Widget
{

    public $dataProvider;

  public function run() {
    return GridView::widget([
        'dataProvider' => $this->dataProvider,
        'summary' => false,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->title, $model->url);
                },
            ],
            'price',
            [
                'format' => 'raw',
                'value' => function () {
                    return '<a href="#" class="btn btn-default pull-right">В корзину</a>';
                }
            ],
        ],
        'tableOptions' => [
            'class' => 'table table-hover'
        ],
        'pager' => [
            'class' => \kop\y2sp\ScrollPager::className(),
            'container' => '.grid-view tbody',
            'item' => 'tr',
            'delay' => 0,
            'paginationSelector' => '.grid-view .pagination',
            'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center; cursor: pointer;"><a>Показать еще</a></td></tr>',
            'noneLeftTemplate' => '',
            'triggerOffset' => 5,
         ],
    ]);
  }

}