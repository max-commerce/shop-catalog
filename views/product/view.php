<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = $product->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog'], 'template' => '<li class="catalog-drodown-menu">{link}'.maxcom\catalog\widgets\CategoriesMenuWidget::widget().'</li>',];
if (@$product->category->parent->parent) {
    $this->params['breadcrumbs'][] = ['label' => $product->category->parent->parent->title, 'url' => $product->category->parent->parent->url];
}
if (@$product->category->parent) {
    $this->params['breadcrumbs'][] = ['label' => $product->category->parent->title, 'url' => $product->category->parent->url];
}
$this->params['breadcrumbs'][] = ['label' => $product->category->title, 'url' => $product->category->url];
$this->params['breadcrumbs'][] = $this->title;

?><div class="product-view-page">

    <div class="row">
	    <div class="col-lg-6">
	    	<div class="panel panel-default">
		    	<img src="http://rio-music.ru/uploads/images/products/1490595213_10320474_800.jpg" class="img-responsive" />

			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default" style="text-align: left !important;">
				<div class="panel-body" style="padding: 29px 40px; line-height: 1.4em;">
					
					<h1 style="margin-top: 0; min-height: 2em;"><?= $product->title ?></h1>

					<div class="pull-right" style="position: relative; top: -10px;">
						<a class="btn btn-default" style="font-size: 18px; padding: 10px 14px;"><i class="fa fa-fw fa-heart-o"></i></a> &nbsp;
						<a class="btn btn-default" style="font-size: 18px; padding: 10px 14px;"><i class="fa fa-fw fa-bar-chart"></i></a> &nbsp;
						<a class="btn btn-default" style="font-size: 18px; padding: 10px 14px;"><i class="fa fa-fw fa-commenting"></i></a>
					</div>
					<?php if ($product->sku) : ?>Артикул: <?= $product->sku ?><br/><?php endif; ?>
					Наличие <span style="font-size: 30px; line-height: 10px; position: relative; top: 6px; margin-left: 5px; color: green;">&bull;&bull;&bull;&bull;&bull;</span>
			    	<br>
			    	<br>
			    	<br>
			    	<div class="" style="font-size: 54px; margin: 15px 0;">
			    		<?= number_format($product->price, 0, ',', '&thinsp;') ?> руб.
			    	</div>
			    	<br>
			    	<br>
			    	<div style="font-size: 13px; color: #999">
			    	<p>Аналог фирменной стойки Касио CS-44P с экономией в деньгах на 1 тысячу рублей. Создана сцепиально для тех, кто считает, что стойка может быть и не оригинальной (ничего электронного, что могло бы сломаться в течение гарантийного срока, нет).</p>
			    	</div>
			    	<br>
			    	<br>
			    	<br>
			    	<br>
			    	<br>
			    	<a class="btn btn-success btn-lg" style="font-size: 21px; padding: 14px 45px;">Добавить в корзину</a>
			    	<a class="btn btn-warning btn-lg" style="font-size: 21px; padding: 14px 60px; margin-left: 8px;">Купить в 1 клик</a>
			    	<br>

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-9">
			<div class="panel panel-default">
				<div class="panel-body" style="padding: 30px; line-height: 1.5em;">
					<p>Верхняя дека:	Ель, Нижняя дека:	Нато (Мора) / Меранти, Обечайка:	Нато (Мора) / Меранти, Гриф:	Нато (Мора), Накладка на гриф:	Палисандр, Бридж:	Палисандр, Глубина корпуса:	95-115 мм, Ширина верхнего порожка:	43 мм, Мензура:	634 мм, Колки:	Литые, хромированные, Предусилитель:	System 65. Аналог фирменной стойки Касио CS-44P с экономией в деньгах на 1 тысячу рублей. Создана сцепиально для тех, кто считает, что стойка может быть и не оригинальной (ничего электронного, что могло бы сломаться в течение гарантийного срока, нет).</p>

					<p>Нато (Мора) / Меранти, Гриф:	Нато (Мора), Накладка на гриф:	Палисандр, Бридж:	Палисандр, Глубина корпуса:	95-115 мм, Ширина верхнего порожка:	43 мм, Мензура:	634 мм, Колки:	Литые, хромированные, Предусилитель:	System 65. Аналог фирменной стойки Касио CS-44P с экономией в деньгах на 1 тысячу рублей. Создана сцепиально для тех, кто считает, что стойка может быть и не оригинальной (ничего электронного, что могло бы сломаться в течение гарантийного срока, нет).</p>

					<p>Верхняя дека:	Ель, Нижняя дека:	Нато (Мора) / Меранти, Обечайка:	Нато (Мора) / Меранти, Гриф:	Нато (Мора), Накладка на гриф:	Палисандр, Бридж:	Палисандр, Глубина корпуса:	95-115 мм, Ширина верхнего порожка:	43 мм, Мензура:	634 мм, Колки:	Литые, хромированные, Предусилитель:	System 65. Аналог фирменной стойки Касио CS-44P с экономией в деньгах на 1 тысячу рублей. Создана сцепиально для тех, кто считает, что стойка может быть и не оригинальной (ничего электронного, что могло бы сломаться в течение гарантийного срока, нет).Нато (Мора) / Меранти, Гриф:	Нато (Мора), Накладка на гриф:	Палисандр, Бридж:	Палисандр, Глубина корпуса:	95-115 мм, Ширина верхнего порожка:	43 мм, Мензура:	634 мм, Колки:	Литые, хромированные, Предусилитель:	System 65. Аналог фирменной стойки Касио CS-44P с экономией в деньгах на 1 тысячу рублей. Создана сцепиально для тех, кто считает, что стойка может быть и не оригинальной (ничего электронного, что могло бы сломаться в течение гарантийного срока, нет).</p>
				<?php if (0) { ?>
					<?= DetailView::widget([
				        'model' => $product
				    ]); ?>
				<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-body" style="padding: 35px; line-height: 1.5em;">
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
				<?php if (0) { ?>
					<?= DetailView::widget([
				        'model' => $product
				    ]); ?>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>

</div>