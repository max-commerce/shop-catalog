<?php

namespace maxcom\catalog\components;

use yii\helpers\ArrayHelper;
use yii;

/**
 * Cart
 */
class Cart extends \yii\base\Component
{
    public static function getTotal()
    {
        $total = 0;
        foreach (self::getItems() as $item) {
            if ($product = Yii::$app->shop->products->findOne($item['product_id'])) {
                $total += $item['amount'] * $product->price;
            }
        }
        return $total;
    }

    public static function getItemsCount()
    {
        $count = 0;
        foreach (self::getItems() as $item) {
            if ($product = Yii::$app->shop->products->findOne($item['product_id'])) {
                $count += $item['amount'];
            }
        }
        return $count;
    }

    public static function getItems() {
        return self::getCartContent();
    }

    public static function getCartContent()
    {
        if (is_string(Yii::app()->user->getState('cart'))) {
            return json_decode(Yii::app()->user->getState('cart'), true);
        } else {
            return Yii::app()->user->getState('cart');
        }
    }
}
