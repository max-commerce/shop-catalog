<?php

namespace maxcom\catalog\controllers;

use maxcom\catalog\models\Brand;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii;

/**
 * Brand controller for the `catalog` module
 */
class BrandController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex($id = null)
    {

        if ($id) {
            $brand = Brand::findOne($id);
            if (empty($brand)) {
                throw new yii\web\NotFoundHttpException('Not found.');
            }
            return $this->render('view', [
                'brand' => $brand,
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Brand::find(),
                'pagination' => [
                    'pageSize' => 999,
                ],
            ]);
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }
}
