<div class="products-filter">
    <div class="panel panel-default">
        <form mehtod="get" class="products-filter-form">
            
            <?php if (Yii::$app->request->get('id')) {
                // фикс для случая когда URL категории не ЧПУ
                echo \yii\helpers\Html::hiddenInput('id', Yii::$app->request->get('id'));
            } ?>

            <?php maxcom\catalog\widgets\CategoriesMenuWidget::begin(['category' => $category]) ?>
            <div class="panel-heading">
                Категории
            </div>
            <?php maxcom\catalog\widgets\CategoriesMenuWidget::end(['category' => $category]) ?>

            <div class="panel-heading">
                Цена
            </div>
            <div class="panel-body">
                <div style="min-height: 15px;">
                    <?= yii\jui\SliderInput::widget([
                        'name' => 'price',
                        'clientOptions' => [
                            'min' => 1,
                            'max' => 1000,
                            'range' => true,
                            'values' => [100, 900],
                        ],
                    ]); ?>
                </div>
                <div style="margin-top: 10px;">
                    <span class="pull-left">0</span>
                    <span class="pull-right">1000</span>
                </div>
            </div>
            <div class="panel-heading">
                Спецпредложения
            </div>
            <div class="panel-body">
                <label><input type="checkbox" name="popular" value="1" <?php if (Yii::$app->request->get('popular')) { ?>checked<?php } ?>/> Популярные</label>
            </div>

            <?php if ($brands) { ?>
            <div class="panel-heading">
                Бренд
            </div>
            <div class="panel-body">
                <ul style="list-style: none; padding: 0;">
                <?php foreach ($brands as $brand) { ?>
                    <li><label><input type="checkbox" name="brand_id[]" value="<?= $brand->id ?>" <?= in_array($brand->id, $brands_checked) ? 'checked' : '' ?>/> <?= $brand->title ?></label></li>
                <?php } ?>
                </ul>
            </div>
            <?php } ?>

            <?php if ($types) { ?>
            <div class="panel-heading">
                Тип товара
            </div>
            <div class="panel-body">
                <ul style="list-style: none; padding: 0;">
                <?php foreach ($types as $type) { ?>
                    <li><label><input type="checkbox" name="product_type_id[]" value="<?= $type->id ?>" <?= in_array($type->id, $types_checked) ? 'checked' : '' ?>/> <?= $type->name ?></label></li>
                <?php } ?>
                </ul>
            </div>
            <?php foreach ($types as $type) { ?>
                <?php foreach ($type->eavAttributes as $attribute) { ?>
                <div class="panel-heading">
                    <?= $attribute->name ?>
                </div>
                <div class="panel-body">
                    <ul style="list-style: none; padding: 0;">
                    <?php foreach ($attribute->values as $value) { ?>
                        <li><label><input type="checkbox" name="attribute[<?= $attribute->id ?>]" value=""/> <?= $value ?></label></li>
                    <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            <?php } ?>
            <?php } ?>

            <?php $this->registerJs("
                $(document).ready(function(){
                    $('.products-filter-form :checkbox').change(function(){
                        $('.products-filter-form').submit();
                    });
                });",
            \yii\web\View::POS_READY); ?>
            <div class="panel-heading">
                Наличие
            </div>
            <div class="panel-body">
                <label><input type="checkbox" /> Только в наличии</label><br/>
                <label><input type="checkbox" /> Доставка 1 неделя</label><br/>
                <label><input type="checkbox" /> Доставка 2 недели</label>
            </div>
        </form>
    </div>
</div>