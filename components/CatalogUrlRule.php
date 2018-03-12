<?php

namespace maxcom\catalog\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii;

class CatalogUrlRule extends BaseObject implements UrlRuleInterface
{

    public $product;
    public $category;

    public function parseRequest($manager, $request)
    {

        $this->product  = Yii::$app->product;
        $this->category = Yii::$app->category;


        if (preg_match('/^catalog\/([^?]+)/ui', $request->pathInfo, $match)) {

            // не ищем, если alias технический (соответствует контроллеру)
            if (!empty($match[1]) && $match[1] != 'category' && $match[1] != 'product') {

                // ищем в таблице продуктов
                if ($this->product->hasAttribute('alias')) {
                    
                    $product = $this->product->find()
                        ->where(['alias' => $match[1]])
                        ->one();

                    if ($product) {
                        return ['catalog/product', ['product' => $product]];
                    }
                }

                // ищем в таблице категорий
                if ($this->category->hasAttribute('alias')) {

                    $category = $this->category->find()
                        ->where(['alias' => $match[1]])
                        ->one();
                    
                    if ($category) {
                        return ['catalog/category', ['category' => $category]];
                    }
                }
            }
        }
        
        return false; // this rule does not apply
    }

    public function createUrl($manager, $route, $params)
    {
        if (preg_match('/^catalog\/category/', $route)) {

            $url = '';
            $_params = [];

            if (!empty($params['alias'])) {
                $url .= '/catalog/' . $params['alias'];
            } elseif (!empty($params['category'])) {
                $url .= '/catalog/' . mb_strtolower($params['category']->alias, 'utf-8');
            } elseif (!empty($params['id'])) {
                $url .= '/catalog/category';
                $_params[] = 'id=' . $params['id'];
            }

            if (isset($params['page']) && $params['page'] != 1) {
                $_params[] = 'page=' . $params['page'];
            }

            return $url . ($_params ? '?' . implode('&', $_params) : '');

        }
        return false; // this rule does not apply
    }
}