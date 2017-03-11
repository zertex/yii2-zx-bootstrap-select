<?php
namespace zertex\bootstrapselect;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

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
    public $selectOptions = [];

    public $selector = 'select-picker';
    
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
            'selector' => $this->selector,
            'menuArrow' => true,
            'tickIcon' => true,
            'selectOptions' => $this->selectOptions,
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
        $js .= '$("' . $o['selector'] . '").selectpicker(' . Json::htmlEncode($o['selectOptions']) . ');' . PHP_EOL;
        
        //Update Bootstrap-Select by :reset click
        $js .= '$(":reset").click(function(){
            $(this).closest("form").trigger("reset");
            $("' . $o['selector'] . '").selectpicker("refresh");
        });';
        
        if (isset($o['val']) && $o['val']) {
            $js .= '$("' . $o['selector'] . '").selectpicker("val", "' . $o['val'] . '");' . PHP_EOL;
        }
        
        $view = $this->getView();
        $view->registerJs($js);
    }
}

