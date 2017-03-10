<?php
namespace zertex\bootstrapselect;

use yii\web\AssetBundle;

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
}
