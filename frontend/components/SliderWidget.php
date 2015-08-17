<?php

class SliderWidget extends CWidget
{
    public function run()
    {
        $model = Slider::model()->findAll();
        $this->render('slider',array('model'=>$model));
    }
}