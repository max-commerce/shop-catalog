<?php

namespace maxcom\catalog\components;

use Yii;

class ImageBehavior extends \yii\base\Behavior
{

    public $imagePath = 'uploads';

    public $imageAttribute = 'image';

    public function getRawImageUrl()
    {
        return $this->imagePath . '/' . $this->owner->{$this->imageAttribute};
    }

    /**
     * Get url to product image. Enter $size to resize image.
     * @param mixed $size New size of the image. e.g. '150x150'
     * @param mixed $resizeMethod Resize method name to override config. resize/adaptiveResize
     * @param mixed $random Add random number to the end of the string
     * @return string
     */
    public function getMainImageUrl($size = false, $resizeMethod = false, $random = false)
    {
        // Path to source image
        $fullPath  = $this->imagePath . '/' . $this->owner->{$this->imageAttribute};
        $fullPathWatemark = $this->imagePath . '/pub/' . $this->owner->{$this->imageAttribute};

        if (!file_exists($fullPath) || is_dir($fullPath) || !is_readable($fullPath))
            return false;
        
        if ($size !== false) {
            $thumbPath = 'assets/thumbs/' . $size;
            if (!file_exists($thumbPath))
                mkdir($thumbPath, 0777, true);
            
            // Path to thumb
            $thumbPath = $thumbPath . '/' . $this->owner->{$this->imageAttribute};

            if (!file_exists($thumbPath)) {
                // Resize if needed
                $sizes  = explode('x', $size);
                $thumb  = \maxcom\phpthumb\PhpThumbFactory::create($fullPath);

                if($resizeMethod === false)
                    $resizeMethod = 'resize';
                $thumb->$resizeMethod($sizes[0],$sizes[1])->save($thumbPath);
            }

            if ($random === true) {
                return $thumbPath . '?' . rand(1, 10000);
            } else {
                return $thumbPath;
            }
        } else {
            if (!file_exists($fullPathWatemark)) {
                // Watermark if needed
                $pic  = \maxcom\phpthumb\PhpThumbFactory::create($fullPath);
                $watermark = \maxcom\phpthumb\PhpThumbFactory::create(Yii::app()->params['watermark']);
                $pic->addWatermark($watermark, 'centerCenter', 60, 0, 0);
                $pic->save($fullPathWatemark);
            }
            if ($random === true) {
                return $fullPathWatemark . '?' . rand(1, 10000);
            } else {
                return $fullPathWatemark;
            }
        }
    }

    /**
     * Returns array of additional images for product.
     * @return array
     */
    public function getImages()
    {
        return [];
    }
}
