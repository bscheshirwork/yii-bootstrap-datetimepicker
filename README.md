yii-bootstrap-timepicker
========================

Yii wrapper for 
https://github.com/tarruda/bootstrap-datetimepicker/
http://tarruda.github.io/bootstrap-datetimepicker/

usage:

First, import the widget class file / Импортируем виджет:

```php
Yii::import('application.vendor.bscheshir.yii-bootstrap-datetimepicker.DateTimePicker', true);
```

Next, call the widget / Вызываем виджет:

```php
$this->widget('DateTimePicker', [
    'model' => $model,
    'attribute' => 'Date',
    // some options, see more at / Немного опций, см. https://github.com/tarruda/bootstrap-datetimepicker/ http://tarruda.github.io/bootstrap-datetimepicker/
    'options' => [
        'showMeridian'=>false,
        'minuteStep'=>5,
        'showInputs'=>false,
        'disableFocus'=>true,
    ],
]);
```

