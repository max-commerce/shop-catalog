<?php

use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'Brands';
$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog'], 'template' => '<li class="catalog-drodown-menu">{link}'.maxcom\catalog\widgets\CategoriesMenuWidget::widget().'</li>',];
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
.brand-default-index ul {
    -moz-column-count: 5;
    -moz-column-gap: 20px;
    -webkit-column-count: 5;
    -webkit-column-gap: 20px;
    column-count: 5;
    column-gap: 20px;
    padding: 0;
    list-style-type: none;
}
</style>
<div class="brand-default-index">
    <h1>Бренды</h1>
    <div class="row">
        <div class="col-lg-12">
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'options' => [
                    'tag' => 'ul',
                ],
                'itemOptions' => [
                    'tag' => 'li',
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a($model->title, ['/catalog/brand', 'id' => $model->id]);
                }
            ]); ?>
        </div>
    </div>
</div>