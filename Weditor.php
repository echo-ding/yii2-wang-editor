<?php
namespace weditor;

use Yii;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;

use weditor\assets\WeditorAsset;


class Weditor extends InputWidget
{
    /**
     * 编辑器传参配置(配置查看wangeditor编辑器官方文档)
     */
    public $width;
    public $height;
    private $url;
    
    public function init()
    {
        //获取组件id
        $this->id = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->id;
        //初始化配置
        if (empty($this->width)) {
            $this->width = 800;
        }
        if (empty($this->height)) {
            $this->height = 300;
        }
        
        $this->url = Url::to(['weditor']);
    }
    
    public function run()
    {
        $this->registerClientScript();
        if ($this->hasModel()) {
            //添加在连接在filed后面文本框
            return Html::activeTextarea($this->model, $this->attribute, ['id' => $this->id, 'class' => 'ding']);
        } else {
            //普通文本框
            return Html::textarea($this->id, $this->value, ['id' => $this->id]);
        }
    }
    
    /**
     * 注册Js
     */
    protected function registerClientScript()
    {
        WeditorAsset::register($this->view);
        $script = <<<"ding"
        wangEditor.config.printLog = false;
        var editor = new wangEditor('$this->id');
        //处理上传文件的路由
        editor.config.uploadImgUrl = "$this->url";
        //上传文件的name
        editor.config.uploadImgFileName = 'ding';
        //定义菜单，删除部分没用的菜单
        editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
            if (item === 'video') {
                return null;
            }
            if (item === 'location') {
                return null;
            }
            return item;
        });
        editor.create();
        $(".wangEditor-container").width("$this->width").height("$this->height");
        menuHight = $(".wangEditor-menu-container").height();
        contH = $this->height - menuHight - 30;
        $(".wangEditor-txt").height(contH);
ding;
        $css = <<<"css"
        // .ding{
        //     width: 800px;
        //     height: 30px;
        // }
css;
        $this->view->registerJs($script, View::POS_END);//POS_END，POS_READY，使用end避免和alert组件的js代码注册到一块，它的alert方法会错误，导致富文本编辑器的js代码无法执行
        // $this->view->registerCss($css);
    }
}

