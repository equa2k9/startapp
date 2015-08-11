<?php

class SliderController extends AdministratorController
{
    public function actions()
    {
        return array(

            'delete' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'Slider',
            ),
        );
    }
    
    public function actionIndex()
    {
        $model = new Slider('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Slider']))
        {
            $model->attributes = $_GET['Slider'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Slider;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

         if (isset($_POST['Slider']))
        {
            $model->attributes = $_POST['Slider'];
            $uploader = CUploadedFile::getInstance($model, 'picture');

            $model->attributes = $_POST['Slider'];

            if ($uploader)
            {
                $sourcePath = pathinfo($uploader->getName());

                $md5_name = md5(date('H:i:s'));

                $fileName = $md5_name . '.' . $sourcePath['extension']; //generate new filename

                $model->picture = $fileName;
//                $model->sort = Categories::model()->count() + 1;
                if ($model->save())
                {
                    if ($uploader)
                    {
                        $uploader->saveAs(Yii::app()->basePath . '/www/images/slider/' . $fileName);

//                        $this->saveThumb($md5_name, $sourcePath['extension']);
                    }

                    $this->redirect($this->createUrl('index'));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        $oldFileName = $model->picture;
        if (isset($_POST['Slider']))
        {
            $model->attributes = $_POST['Slider'];

            $uploader = CUploadedFile::getInstance($model, 'picture');

            if ($uploader)
            {
                $sourcePath = pathinfo($uploader->getName());
                $md5_name = md5(date('H:i:s'));
                $fileName = $md5_name . '.' . $sourcePath['extension']; //generate new filename
                $model->picture = $fileName;
            }

            if ($model->save())
            {
                if ($uploader)
                {
                    @unlink(Yii::app()->basePath . '/www/images/slider/' . $oldFileName);
//                    @unlink(Yii::app()->basePath . '/www/images/categories/thumb/' . $oldFileName);

                    $uploader->saveAs(Yii::app()->basePath . '/www/images/slider/' . $fileName);

//                    $this->saveThumb($md5_name, $sourcePath['extension']);
                }

                $this->redirect($this->createUrl('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    
    public function loadModel($id)
    {
        $model = Slider::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'slider-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Lists all models.
     */
}

?>