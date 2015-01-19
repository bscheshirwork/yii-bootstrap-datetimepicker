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
    public $options = array();

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
        //bootstrap-datetimepicker/build/js/
        //bootstrap-datetimepicker/build/css/
        if (YII_DEBUG)
            $bujs = Yii::app()->assetManager->publish(dirname(__FILE__) . "{$ds}..{$ds}..{$ds}tarruda{$ds}bootstrap-datetimepicker{$ds}src{$ds}js");
        else
            $bujs = Yii::app()->assetManager->publish(dirname(__FILE__) . "{$ds}..{$ds}..{$ds}tarruda{$ds}bootstrap-datetimepicker{$ds}build{$ds}js");
        //duplicate if dev
        $langjs = Yii::app()->assetManager->publish(dirname(__FILE__) . "{$ds}..{$ds}..{$ds}tarruda{$ds}bootstrap-datetimepicker{$ds}src{$ds}js{$ds}locales");
        $bucss = Yii::app()->assetManager->publish(dirname(__FILE__) . "{$ds}..{$ds}..{$ds}tarruda{$ds}bootstrap-datetimepicker{$ds}build{$ds}css");
        $cs = Yii::app()->clientScript;
        if ($scriptPosition === null)
            $scriptPosition = $cs->coreScriptPosition;
        //bootstrap-datetimepicker.min.js
        //bootstrap-datetimepicker.min.css
        $cs->registerScriptFile($bujs . '/bootstrap-datetimepicker' . (YII_DEBUG ? '' : '.min') . '.js', $scriptPosition);
        //approximate
        $cs->registerScriptFile($langjs . '/bootstrap-datetimepicker' . (Yii::app()->language) . '.js', $scriptPosition);
        $cs->registerCssFile($bucss . '/bootstrap-datetimepicker' . 'min' . '.css');
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

        $this->htmlOptions['autocomplete'] = 'off';

        self::initClientScript($this->scriptPosition);
        $options = $this->options !== null ? CJavaScript::encode($this->options) : '';
        Yii::app()->clientScript->registerScript(__CLASS__ . '#' . $this->id,
            "jQuery('{$this->selector}').datetimepicker({$options})"
        );

        echo '<div class="input-append bootstrap-datetimepicker">' .
            CHtml::textField($this->name, $this->value, $this->htmlOptions) .
            '<span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span></div>';
    }
}
