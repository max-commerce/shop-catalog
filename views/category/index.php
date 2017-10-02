<?php

use yii\helpers\Html;

$this->title = $category->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog'], 'template' => '<li class="catalog-drodown-menu">{link}'.maxcom\catalog\widgets\CategoriesMenuWidget::widget().'</li>',];
if (@$category->parent->parent) {
    $this->params['breadcrumbs'][] = ['label' => $category->parent->parent->title, 'url' => $category->parent->parent->url];
}
if (@$category->parent) {
    $this->params['breadcrumbs'][] = ['label' => $category->parent->title, 'url' => $category->parent->url];
}
$this->params['breadcrumbs'][] = $this->title;

?><div class="category-default-index">
    <h1><?= Html::encode($category->hasAttribute('title_h1') && $category->title_h1 ? $category->title_h1 : $category->title) ?></h1>


    <div class="row">
        <div class="col-lg-3">
            
            <?= maxcom\catalog\widgets\ProductsFilterWidget::widget(['category' => $category]) ?>

        </div>
        <div class="col-lg-9">

            <?= maxcom\catalog\widgets\ProductsListWidget::widget(['dataProvider' => $dataProvider]) ?>

            <?php if (trim(strip_tags($category->description))) : ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= $category->description ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>