<?php

namespace common\widgets\weditor\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author 丁冉
 */
class WeditorAsset extends AssetBundle
{
    public $css = [
        'dist/css/wangEditor.min.css',
    ];
    
    public $js = [
        'dist/js/lib/jquery-1.10.2.min.js',
        'dist/js/wangEditor.min.js',
    ];
    
    public $depends = [

    ];
    
    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'vendor';
    }
}
