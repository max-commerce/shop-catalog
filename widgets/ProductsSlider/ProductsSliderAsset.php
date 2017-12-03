<?php

namespace maxcom\catalog\widgets\ProductsSlider;

use yii\web\AssetBundle;

class ProductsSliderAsset extends AssetBundle
{
	public $sourcePath = '@vendor/max-commerce/shop-catalog/widgets/ProductsSlider/assets';

    public $css = [
        'style.css',
    ];

    public $js = [
        'script.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
