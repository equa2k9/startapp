<?php
class AjaxAdd extends CommonAction
{
    public $model_name; // model name

    public function run()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            if (Yii::app()->request->isPostRequest)
            {
                $data = array();
                $model = new $this->model_name;
                $model->attributes = Yii::app()->request->getPost($this->model_name);
                if ($model->save())
                {
                    $data['status'] = 'success';
                }
                else
                {
                    $data = $model->errors;
                }
                echo CJSON::encode($data);
            }
            Yii::app()->end();
        }
        else
        {
            Yii::app()->user->setFlash('danger', 'Something wrong with request, try again later');
            $this->redirect(Yii::app()->createUrl('administrator'));
        }
    }
}