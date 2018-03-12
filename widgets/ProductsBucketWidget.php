<?php

namespace maxcom\catalog\widgets;

use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\base\Widget;

class ProductsBucketWidget extends Widget
{

	/**
	*
	*/
    public $bucket;

    /**
	*
	*/
    public $layout = '{title}{items}';

    /**
	*
	*/
    public $title = '';

    /**
	*
	*/
    public $titleOptions = [];

    /**
	*
	*/
    public $itemsOptions = [];

    /**
	*
	*/
    public $dataProvider;

    /**
    *
    */
    public function init()
    {
    	if (empty($this->bucket)) {
    		throw new \yii\base\InvalidConfigException;
    	}

    	$bucket = new \maxcom\catalog\components\ProductBucket();

		$this->dataProvider = new ArrayDataProvider([
		    'allModels' => $bucket->getBucket($this->bucket),
		    'pagination' => [
		        'pageSize' => 999,
		    ],
		]);
    	parent::init();
    }

    /**
    *
    */
    public function run()
    {
    	if ($this->dataProvider->getModels() && $this->dataProvider->totalCount) {
	    	if ($this->title) {
	    		$title = Html::tag('div', $this->title, $this->titleOptions);
	    	} else {
	    		$title = '';
	    	}

	        $items = $this->render('products_list', [
	            'dataProvider' => $this->dataProvider
	        ]);
	    	$items = Html::tag('div', $items, $this->itemsOptions);

	    	return strtr($this->layout, [
				'{title}' => $title,
				'{items}' => $items
			]);
    	}
    }
}
