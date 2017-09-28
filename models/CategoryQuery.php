<?php

namespace maxcom\catalog\models;
use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{

	public function active()
    {
        $this->andWhere(['status' => 1]);
        return $this;
    }

	public function roots()
    {
        $this->andWhere(['or', ['parent_id' => null], ['parent_id' => 0]]);
        return $this;
    }
}