<?php

namespace maxcom\catalog\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii;

/**
 * Default controller for the `catalog` module
 */
class CategoryController extends Controller
{
	
	public $category;

	public $product;

	public function init()
    {
        $this->product = Yii::$app->product;
        $this->category = Yii::$app->category;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id = null, $category = null)
    {
        if (empty($category) && empty($id)) {
            throw new yii\web\BadRequestHttpException('Bad Request.');
        }

        if (empty($category) && !empty($id)) {
            $category = $this->category->findOne($id);
        }

        if (empty($category)) {
            throw new yii\web\NotFoundHttpException('Not found.');
        }

        if (!$category->status) {
            throw new yii\web\NotFoundHttpException('Not found.');
        }

        if ($category->hasAttribute('alias') && !empty($category->alias) && Yii::$app->request->pathInfo != trim($category->url, '/')) {
            return $this->redirect($category->url, 301);
        }

    	$dataProvider = new ActiveDataProvider([
		    'query' => $this->product->find()->byCategoryWithChilds($category->id)->withFilter(Yii::$app->request->get()),
		    'pagination' => [
                'pageSize' => 30,
		        'defaultPageSize' => 30,
		    ],
		]);

        return $this->render('index', [
        	'category' => $category,
        	'dataProvider' => $dataProvider,
        ]);
    }
}
