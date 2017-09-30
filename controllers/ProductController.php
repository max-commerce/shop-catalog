<?php

namespace maxcom\catalog\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii;

/**
 * Default controller for the `catalog` module
 */
class ProductController extends Controller
{

	public $product;

	public function init()
    {
        $this->product = Yii::$app->product;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id = null, $product = null)
    {

        if (empty($product) && empty($id)) {
            throw new yii\web\BadRequestHttpException('Bad Request.');
        }

        if (empty($product) && !empty($id)) {
            $product = $this->product->findOne($id);
        }

        if (empty($product)) {
            throw new yii\web\NotFoundHttpException('Not found.');
        }

        if (!$product->status) {
            throw new yii\web\NotFoundHttpException('Not found.');
        }

        if ($product->hasAttribute('alias') && !empty($product->alias) && Yii::$app->request->url != $product->url) {
            return $this->redirect($product->url, 301);
        }

        return $this->render('view', [
        	'product' => $product
        ]);
    }
}