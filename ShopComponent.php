<?php

namespace maxcom\catalog;

/**
 * ShopComponent
 */
class ShopComponent extends \yii\base\Component
{
    const EVENT_INIT = 'init';

    public $categories;

    public $products;

    public $brands;

    public $cart;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->categories = \Yii::createObject([
            'class' => 'maxcom\catalog\models\Category'
        ]);
        $this->products = \Yii::createObject([
            'class' => 'maxcom\catalog\models\Product'
        ]);
        $this->brands = \Yii::createObject([
            'class' => 'maxcom\catalog\models\Brand'
        ]);
        $this->cart = \Yii::createObject([
            'class' => 'maxcom\catalog\components\Cart'
        ]);

        \Yii::$app->urlManager->rules[] = \Yii::createObject([
            'class' => 'maxcom\catalog\components\CatalogUrlRule'
        ]);

        $this->trigger(self::EVENT_INIT);
    }
}
