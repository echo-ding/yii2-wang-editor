# Yii2 扩展-富文本编辑器（wangEditor） 

为yii2准备的简洁的wangEditor富文本编辑器ventor

## 安装方法：

> 在yii站点根目录下执行 `omposer require ibunao/yii2-weditor`安装


## 使用方法：

### 控制器
在将使用文本编辑器 `wangEditor` 的控制器中加入下面代码，用来接收图片

```
public function actions()
{
    return [
        'weditor' => [
            'class' => 'weditor\WeditorAction',
            'config'=>[
                //上传图片配置
                //图片保存路径,及名字
                'pathFormat' => "/imagebiubiu/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                /* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
			    /* {rand:6} 会替换成随机数,后面的数字是随机数的位数 */
			    /* {time} 会替换成时间戳 */
			    /* {yyyy} 会替换成四位年份 */
			    /* {yy} 会替换成两位年份 */
			    /* {mm} 会替换成两位月份 */
			    /* {dd} 会替换成两位日期 */
			    /* {hh} 会替换成两位小时 */
			    /* {ii} 会替换成两位分钟 */
			    /* {ss} 会替换成两位秒 */
            ]
        ],
    ];
}
```
### 使用编辑器小部件
第一种调用方式：

在对应的渲染页面，即views下的页面中
```
<?=weditor\Weditor::widget(['width'=>1000, 'height'=>200])?>
```
第二种调用方式：
结合form表单使用
```
<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'content')->widget(weditor\Weditor::className(),
                ['width'=>1000, 'height'=>200]); ?>
				//设置宽高
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            
        <?php ActiveForm::end(); ?>
    </div>
</div>
```
> 推荐使用第二种方式  

> 注意，宽高会受父元素的影响 ,比如`<div class="col-lg-12">`
