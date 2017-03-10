Yii2 bootstrap-select
=====================
Bootstrap-select widget

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist zertex/yii2-zx-bootstrap-select "dev-master"
```

or add

```
"zertex/yii2-zx-bootstrap-select": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by :


```php
<?= $form->field($model, 'field')->widget(Select::className(), [
    'selector' => '.select-picker',
    'options' => [
        'data-live-search' => 'true',
     ],
    'items' => [
        '1' => 'Item 1',
        '2' => 'Item 2',
        '3' => 'Item 3',
        '4' => 'Item 4',
        '5' => 'Item 5',
    ]
]);
?>```