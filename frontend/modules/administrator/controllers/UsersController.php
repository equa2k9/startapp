<?php

class UsersController extends AdministratorController
{

    public function actions()
    {
        return array(
//            'index' => 'common.components.actions.DriverAction',
//            'forms' => 'common.components.actions.DriverAction',
            'update' => array(
                'class' => 'common.components.actions.UpdateEditable',
                'model_name' => 'Users',
            ),
            'delete' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'Users',
            ),
//            'setRate' => array(
//                'class' => 'common.components.actions.AjaxAdd',
//                'model_name' => 'DriversRate',
//            ),
//            'addComment' => array(
//                'class' => 'common.components.actions.AjaxAdd',
//                'model_name' => 'DriversComments',
//            ),
        );
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $model->scenario = 'updateuser';
        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionIndex()
    {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
        {
            $model->attributes = $_GET['Users'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Users::model()->findByPk($id);
        if ($model === null)
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
