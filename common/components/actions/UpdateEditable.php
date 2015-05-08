<?php

class UpdateEditable extends CommonAction
{
    public $model_name; // model name

    public function run()
    {
        $model_name = $this->model_name;
        try {
            if (Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest) {

                $model = $model_name::model()->findByPk(Yii::app()->request->getParam('pk'));

                foreach ($model->attributes as $key => $attribute) {
                    if ($key == Yii::app()->request->getParam('name')) {
                        $model->setAttribute(
                            Yii::app()->request->getParam('name'),
                            Yii::app()->request->getParam('value')
                        );
                    }
                }
                $model->save();
            }
        } catch (CException $e) {
            echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));

            return;
        }
        echo CJSON::encode(array('success' => true));
    }
}