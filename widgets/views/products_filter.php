<div class="products-filter">
    <div class="panel panel-default">
        
        <?php maxcom\catalog\widgets\CategoriesMenuWidget::begin(['category' => $category]) ?>
        <div class="panel-heading">
            Категории
        </div>
        <?php maxcom\catalog\widgets\CategoriesMenuWidget::end(['category' => $category]) ?>

        <div class="panel-heading">
            Цена
        </div>
        <div class="panel-body">
            <?= yii\jui\SliderInput::widget([
                'name' => 'amount',
                'clientOptions' => [
                    'min' => 1,
                    'max' => 1000,
                    'range' => true,
                    'values' => [100, 900],
                ],
            ]); ?>
            <div style="margin-top: 10px;">
                <span class="pull-left">0</span>
                <span class="pull-right">1000</span>
            </div>
        </div>
        <div class="panel-heading">
            Бренд
        </div>
        <div class="panel-body">
            <label><input type="checkbox" /> Yamaha</label><br/>
            <label><input type="checkbox" /> Casio</label><br/>
            <label><input type="checkbox" /> Fender</label><br/>
            <label><input type="checkbox" /> Gibson</label><br/>
            <label><input type="checkbox" /> BOSS</label>
        </div>
        <div class="panel-heading">
            Наличие
        </div>
        <div class="panel-body">
            <label><input type="checkbox" /> Только в наличии</label><br/>
            <label><input type="checkbox" /> Доставка 1 неделя</label><br/>
            <label><input type="checkbox" /> Доставка 2 недели</label>
        </div>
        <!--
        <div class="panel-heading">
            Длина
        </div>
        <div class="panel-body">
            <label><input type="checkbox" /> 135 мм</label><br/>
            <label><input type="checkbox" /> 355 мм</label><br/>
            <label><input type="checkbox" /> 655 мм</label>
        </div>
        -->
    </div>
</div>