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
    'model'     => $model,
    'attribute' => 'Date',
    // опции см. http://tarruda.github.io/bootstrap-datetimepicker/
    'options'   => [
        'language' => 'ru',
        'format'   => 'yyyy-MM-dd hh:mm:ss',//yyyy-MM-dd HH:mm:ss
//maskInput: true,           // disables the text input mask
//pickDate: true,            // disables the date picker
//pickTime: true,            // disables de time picker
//pick12HourFormat: false,   // enables the 12-hour format time picker
//pickSeconds: true,         // disables seconds in the time picker
//startDate: -Infinity,      // set a minimum date
//endDate: Infinity          // set a maximum date
    ],
]);
```

