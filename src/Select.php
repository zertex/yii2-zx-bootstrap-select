<?php
namespace zertex\bootstrapselect;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

class Select extends InputWidget
{
    /**
     * Items for dropDownList
     * @var array
     */
    public $items = [];
    /**
     * Options of JavaScript plugin
     * @see https://silviomoreto.github.io/bootstrap-select/ Documentation of JavaScript plugin
     * @var array
     */
    public $clientOptions = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
    }
    /**
     * @return string
     */
    public function run()
    {
        SelectAsset::register($this->getView());
        parent::run();
        $this->registerJs();
        return ($this->hasModel() ? Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options) : Html::dropDownList($this->name, $this->value, $this->items, $this->options));
    }
    /**
     * Registration JavaScript scripts.
     */
    private function registerJs()
    {
        $o = ArrayHelper::merge([
            'selector' => 'select-picker',
            'menuArrow' => true,
            'tickIcon' => true,
            'selectpickerOptions' => [
                'style' => 'btn-default form-control',
            ],
        ], $this->clientOptions); 
        if (!is_string($o['selector']) || empty($o['selector']))
        {
            return false;
        }
        $js = '';
        if ($o['menuArrow']) {
            $js .= '$("' . $o['selector'] . '").addClass("show-menu-arrow");' . PHP_EOL;
        }
        if ($o['tickIcon']) {
            $js .= '$("' . $o['selector'] . '").addClass("show-tick");' . PHP_EOL;
        }
        //Enable Bootstrap-Select for $o['selector']
        $js .= '$("' . $o['selector'] . '").selectpicker(' . Json::htmlEncode($o['selectpickerOptions']) . ');' . PHP_EOL;
        
        //Update Bootstrap-Select by :reset click
        $js .= '$(":reset").click(function(){
            $(this).closest("form").trigger("reset");
            $("' . $o['selector'] . '").selectpicker("refresh");
        });';
        
        $view = $this->getView();
        $view->registerJs($js);
    }
}

