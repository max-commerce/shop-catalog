<div class="products-filter">
    <div class="panel panel-default">
        <form mehtod="get">        
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
            <?php if ($brands) { ?>
            <div class="panel-heading">
                Бренд
            </div>
            <div class="panel-body">
                <ul style="list-style: none; padding: 0;">
                <?php foreach ($brands as $brand) { ?>
                    <li><label><input type="checkbox" name="brands[]" value="<?= $brand->id ?>" <?= in_array($brand->id, $brands_checked) ? 'checked' : '' ?>/> <?= $brand->title ?></label></li>
                <?php } ?>
                </ul>
            </div>
            <?php } ?>

            <?php $this->registerJs("
                $(document).ready(function(){
                    $(':checkbox[name=\"brands[]\"]').change(function(){
                        $(this).closest('form').submit();
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