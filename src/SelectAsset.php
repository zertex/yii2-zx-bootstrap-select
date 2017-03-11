<?php
namespace zertex\bootstrapselect;

use yii\web\AssetBundle;
use Yii;

class SelectAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bootstrap-select/bootstrap-select/dist';
    public $css = [
        'css/bootstrap-select.min.css',
    ];
    public $js = [
        'js/bootstrap-select.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];   
    
    public function init()
    {
        parent::init();
        $this->js[] = 'js/i18n/defaults-' . Yii::$app->language . '.js'; // dynamic file added
    }
}
