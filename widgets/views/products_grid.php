<?php

use yii\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function($model) {
                return Html::a($model->title, $model->url);
            },
        ],
        'price',
    ],
]);