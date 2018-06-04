<?php

namespace maxcom\catalog\components;

use Yii;

class ImageByIdBehavior extends \yii\base\Behavior
{
    public $path = 'images';

    public $extensions = ['svg', 'png', 'jpg'];

    public function getImageUrl()
    {
        foreach ($this->extensions as $ext) {
            $image = "/{$this->path}/{$this->owner->id}.{$ext}";
            if (file_exists(Yii::getAlias('@webroot') . $image)) {
                return $image;
            }
        }
        return null;
    }
}
