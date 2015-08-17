<?php
class DeleteAjaxAction extends CommonAction
{
    public $model_name;

    public function run()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->request->isPostRequest) {
                $model_name = $this->model_name;
                $model_name::model()->deleteByPk(Yii::app()->request->getParam('id'));
                Yii::app()->end();
            }
        }
    }
}