<?php
namespace weditor;

use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;

class WeditorAction extends Action
{
    /**
     * 配置文件
     * @var array
     */
    public $config = [];
    
    public function init()
    {
        parent::init();
        //close csrf
        Yii::$app->request->enableCsrfValidation = false;
        //默认设置
        $_config = require(__DIR__ . '/config.php');
        //load config file
        $this->config = ArrayHelper::merge($_config, $this->config);
    }
    
    public function run()
    {
        $uploader = new Uploader('ding', $this->config);
        $result = $uploader->getFileInfo();
        if ($result['state']) {
            echo "error|".$result['state'];
        }else{
            echo $result['url'];
        }
    }
    

}
