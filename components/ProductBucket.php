<?php

namespace maxcom\catalog\components;

use yii\base\Component;
use Yii;

/**
*
*/
class ProductBucket extends Component
{

    /**
    *
    */
    const SESSION_KEY = 'product-bucket';

    /**
    *   Buckets storage
    */
    private $_storage;


    public function init()
    {
        parent::init();
        $this->loadFromStorage();
    }

    /**
    *
    */
    public function put($bucketName, $product)
    {
        // определяем id продукта
        $product_id = is_int($product) ? $product : $product->id;

        if (isset($this->_storage[$bucketName][$product_id])) {
            // nothing to do..
        } else {
            $this->_storage[$bucketName][$product_id] = $product;
        }

        $this->saveToStorage();
    }

    /**
     *
     */
    public function remove($bucketName, $product)
    {
        $product_id = is_int($product) ? $product : $product->id;
        
        unset($this->_storage[$bucketName][$product_id]);

        // если после удаления в бакете ничего не осталось, то удаляем сам бакет
        if (empty($this->_storage[$bucketName])) {
            unset($this->_storage[$bucketName]);
        }

        $this->saveToStorage();
    }

    /**
     *
     */
    public function getBuckets()
    {
        return $this->_storage;
    }

    /**
     *
     */
    public function getBucketsNames()
    {
        return $this->buckets ? array_keys($this->buckets) : [];
    }

    /**
     *
     */
    public function getBucketsSizes()
    {
        if (empty($this->buckets)) {
            return null;
        }
        $result = [];
        foreach ($this->buckets as $bucketName=>$subset) {
            $result[$bucketName] = count($subset);
        }
        return $result;
    }

    /**
    *
    */
    public function getBucket($bucketName)
    {
        if (isset($this->_storage[$bucketName]) && is_array($this->_storage[$bucketName])) {
            return $this->_storage[$bucketName];
        } else {
            return null;
        }
    }

    /**
    *
    */
    public function getBucketSize($bucketName)
    {
        if ($bucket = $this->getBucket($bucketName)) {
            return count($bucket);
        } else {
            return 0;
        }
    }

    /**
    *
    */
    public function saveToStorage()
    {
        $_storage = [];
        if (!empty($this->_storage)) {
            // serialize prepare: substitute product object to its id
            foreach ($this->_storage as $bucket=>$subset) {
                foreach ($subset as $product_id=>$product) {
                    $_storage[$bucket][$product_id] = $product_id;
                }
            }
        }
        return Yii::$app->session->set(self::SESSION_KEY, json_encode($_storage));
    }

    /**
    *
    */
    public function loadFromStorage()
    {
        $_storage = (array)json_decode(Yii::$app->session->get(self::SESSION_KEY));
        // serialize restore: substitute product ids to whole objects
        foreach ($_storage as $bucket=>$subset) {
            foreach ($subset as $product_id) {
                $this->_storage[$bucket][$product_id] = \maxcom\catalog\models\Product::findOne($product_id);
            }
        }
    }
}
