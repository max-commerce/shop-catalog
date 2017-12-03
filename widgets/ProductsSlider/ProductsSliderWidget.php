<?php

namespace maxcom\catalog\widgets\ProductsSlider;

use yii\base\Widget;
use maxcom\catalog\models\Product;

class ProductsSliderWidget extends Widget
{
	public $title;

	public $items;

	public $limit = 12;

	public function init()
	{
		parent::init();
		$this->items = Product::find()->limit($this->limit)->all();
	}

	public function run()
	{
		ProductsSliderAsset::register($this->view);
		return $this->render('products_slider', [
			'title' => $this->title,
			'items' => $this->items
		]);
	}
}
