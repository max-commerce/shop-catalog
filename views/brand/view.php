<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = $brand->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog'], 'template' => '<li class="catalog-drodown-menu">{link}'.maxcom\catalog\widgets\CategoriesMenuWidget::widget().'</li>',];
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['/catalog/brand']];
$this->params['breadcrumbs'][] = $this->title;

?><div class="brand-view-page">
	<h1><?= $this->title ?></h1>
    <div class="row">
	    <div class="col-lg-12">
	    	<?= $brand->description ?>
		</div>
	</div>
</div>