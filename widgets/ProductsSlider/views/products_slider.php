<?php

use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-9">
        <h3><?= $title ?></h3>
    </div>
    <div class="col-md-3">
        <!-- Controls -->
        <div class="controls pull-right">
            <a class="left fa fa-chevron-left btn btn-default" href="#carousel-example" data-slide="prev"></a>
            <a class="right fa fa-chevron-right btn btn-default" href="#carousel-example" data-slide="next"></a>
        </div>
    </div>
</div>
<div id="carousel-example" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php $chunks = array_chunk($items, 4); ?>
        <?php foreach ($chunks as $key => $chunk) : ?>
        <div class="item<?= $key == 0 ? ' active' : '' ?>">
            <div class="row">
                <?php foreach ($chunk as $product) : ?>
                <div class="col-sm-3">
                    <div class="col-item">
                        <a href="<?= Url::to($product->url) ?>">
                            <div class="photo">
                                <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                            </div>
                        </a>
                        <div class="info">
                            <div style="min-height: 50px;">
                                <a href="<?= Url::to($product->url) ?>"><?= $product->title ?></a>
                            </div>
                            <div class="separator clear-left">
                                <div class="btn-details"><?= $product->price ?> руб.</div>
                                <div class="btn-add">
                                    <?= maxcom\cart\widgets\AddToCartWidget::widget(['product' => $product, 'btnText' => '<i class="fa fa-shopping-cart"></i> В корзину', 'btnOptions' => ['class' => 'btn btn-success btn-block']]) ?>
                                </div>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>