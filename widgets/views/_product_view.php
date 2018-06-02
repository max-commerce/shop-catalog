<?php

use yii\helpers\Html;

?><div class="product">
	<h2><?= Html::a($model->title, $model->url) ?></h2>
	<div class="price"><?= $model->price ?></div>
</div>