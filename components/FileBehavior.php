<?php

namespace maxcom\catalog\components;

use Yii;

class FileBehavior extends \yii\base\Behavior
{
    /**
     * Returns array of additional files for product (downloads, specifications etc.).
     * @return array
     */
    public function getFiles()
    {
        return [];
    }
}
