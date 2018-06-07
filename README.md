# shop-catalog

## Общая конфигурация

Базовая конфигурация компонента Shop в `main.php`:
```
'components' => [
    ..
    'shop' => [
        'class' => 'maxcom\catalog\ShopComponent',
    ],
    ..
]
```

Вариант конфигурации компонента Shop с дополнительными событиями (в примере ниже на событие afterFind модели Category добавляется поведение ImageByIdBehavior):
```
'components' => [
    ..
    'shop' => [
        'class' => 'maxcom\catalog\ShopComponent',
        'on init' => function($event){
            Event::on('maxcom\catalog\models\Category', 'afterFind', function ($e) {
                $e->sender->attachBehavior('image', [
                    'class' => 'maxcom\catalog\components\ImageByIdBehavior',
                    'path' => 'images/category'
                ]);
            });
        }
    ],
    ..
]
```


## Категории товаров

Работа с категориями осуществляется через глобальный компонент `Yii::$app->shop->categories`.

**#1 Вывод меню категорий верхнего уровня:**
```
<ul>
  <?php foreach (Yii::$app->shop->categories->find()->roots()->limit(99)->all() as $category): ?>
    <li><a href="<?= $category->url ?>"><?= Html::encode($category->title) ?></a></li>
  <?php endforeach; ?>
</ul>
```

**#2 Вывод двухуровневого меню категорий:**
```
<ul>
  <?php foreach (Yii::$app->shop->categories->find()->roots()->all() as $category): ?>
  <li<?php if ($category->hasChilds()): ?> class="expandable"<?php endif; ?>>
    <a href="<?= $category->url ?>"><?= Html::encode($category->title) ?></a>
    <?php if ($category->hasChilds()): ?>
    <ul>
      <?php foreach ($category->childs as $child_category): ?>
        <li><a href="<?= $child_category->url ?>"><?= Html::encode($child_category->title) ?></a></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </li>
  <?php endforeach; ?>
</ul>
```

**#3 Вывод двухуровневого меню категорий с картинкой (поведение ImageByIdBehavior):**
```
<ul>
    <?php foreach (Yii::$app->shop->categories->find()->roots()->all() as $category): ?>
    <li<?php if ($category->hasChilds()): ?> class="expandable"<?php endif; ?>>
        <a href="<?= $category->url ?>">
            <?= $category->imageUrl ? "<img src=\"" . $category->imageUrl . "\" />" : '' ?><?= Html::encode($category->title) ?>
        </a>
        <?php if ($category->hasChilds()): ?>
        <ul>
            <?php foreach ($category->childs as $child_category): ?>
            <li><a href="<?= $child_category->url ?>"><?= Html::encode($child_category->title) ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
```
