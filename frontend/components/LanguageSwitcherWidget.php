<?php
class LanguageSwitcherWidget extends CWidget
{
    public function run()
    {
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $links = array();
        foreach (DMultilangHelper::suffixList() as $suffix => $name){
            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;
            $links[] = CHtml::tag('div', array('class'=>(YII::app()->language==$url)?"btn btn-warning elements":'btn btn-default elements'), Chtml::image(Yii::app()->theme->baseUrl."/img/".(($suffix!="")?$suffix:'_ru').'.png').CHtml::link($name, $url));
            
        }
       
        echo CHtml::tag('div
', array('class'=>'language'), implode("\n", $links)); 
    }
}