<?php

/**
 * Wrapper for bootstrap-timepicker,
 * https://github.com/tarruda/bootstrap-datetimepicker/
 * http://tarruda.github.io/bootstrap-datetimepicker/
 */
class DateTimePicker extends CInputWidget
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * http://www.yiiframework.com/doc/api/1.1/CClientScript#registerScriptFile-detail
     * @var integer Script position
     */
    public $scriptPosition = null;

    /**
     * @var string Html element selector
     */
    public $selector;

    public static function initClientScript($scriptPosition = null)
    {
        $ds = DIRECTORY_SEPARATOR;
        //assets/js/
        //assets/css/
        $bu = Yii::app()->assetManager->publish(__DIR__ . "{$ds}assets");
        $cs = Yii::app()->clientScript;
        if ($scriptPosition === null)
            $scriptPosition = $cs->coreScriptPosition;
        //bootstrap-datetimepicker.min.js
        //bootstrap-datetimepicker.js
        //locales/bootstrap-datetimepicker.ru.js
        //bootstrap-datetimepicker.min.css
        $cs->registerScriptFile($bu . "{$ds}js{$ds}bootstrap-datetimepicker" . (YII_DEBUG ? '' : '.min') . '.js', $scriptPosition);
        //approximate
        $cs->registerScriptFile($bu . "{$ds}js{$ds}locales{$ds}bootstrap-datetimepicker." . (Yii::app()->getLanguage()) . '.js', $scriptPosition);
        $cs->registerCssFile($bu . "{$ds}css{$ds}bootstrap-datetimepicker" . (YII_DEBUG ? '' : '.min') . '.css');
    }

    public function run()
    {
        if ($this->selector === null) {
            list($this->name, $this->id) = $this->resolveNameId();
            $this->selector = '#' . $this->id;
        }

        if (!isset($this->htmlOptions['value'])) {
            if ($this->hasModel()) {
                $this->value = CHtml::resolveValue($this->model, $this->attribute);
            }
        } else {
            $this->value = $this->htmlOptions['value'];
            unset($this->htmlOptions['value']);
        }

        if (!isset($this->htmlOptions['data-format']))
            $this->htmlOptions['data-format'] = "dd/MM/yyyy hh:mm:ss";

        $this->htmlOptions['autocomplete'] = 'off';

        self::initClientScript($this->scriptPosition);
        $options = $this->options !== null ? CJavaScript::encode($this->options) : '';
        Yii::app()->clientScript->registerScript(__CLASS__ . '#' . $this->id,
            "jQuery('{$this->selector}_h').datetimepicker({$options})"
        );

        echo '<div class="input-append" id="' . $this->id . '_h">' .
            CHtml::textField($this->name, $this->value, $this->htmlOptions) .
            '<span class="add-on">
            <i class="icon-calendar" data-date-icon="icon-calendar" data-time-icon="icon-time">
            </i></span></div>';
    }
}
