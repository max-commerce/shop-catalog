# shop-catalog

## Категории товаров

Работа с категориями осуществляется через глобальный компонент `Yii::$app->shop_categories`

#1 Вывод меню категорий верхнего уровня:
```
<ul>
  <?php foreach (Yii::$app->shop_categories->find()->roots()->all() as $category): ?>
    <li><a href="<?= $category->url ?>"><?= Html::encode($category->title) ?></a></li>
  <?php endforeach; ?>
</ul>
```

#2 Вывод двухуровневого меню категорий:
```
<ul>
  <?php foreach (Yii::$app->shop_categories->find()->roots()->all() as $category): ?>
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
