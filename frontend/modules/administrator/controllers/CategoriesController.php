<?php

class CategoriesController extends AdministratorController
{

    
    public function actions()
    {
        return array(

            'delete' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'Categories',
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Categories;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Categories']))
        {
            $model->attributes = $_POST['Categories'];
            $uploader = CUploadedFile::getInstance($model, 'picture');

            $model->attributes = $_POST['Categories'];

            if ($uploader)
            {
                $sourcePath = pathinfo($uploader->getName());

                $md5_name = md5(date('H:i:s'));

                $fileName = $md5_name . '.' . $sourcePath['extension']; //generate new filename

                $model->picture = $fileName;
                $model->sort = Categories::model()->count() + 1;
                if ($model->save())
                {
                    if ($uploader)
                    {
                        $uploader->saveAs(Yii::app()->basePath . '/www/images/categories/' . $fileName);

                        $this->saveThumb($md5_name, $sourcePath['extension']);
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
        if (isset($_POST['Categories']))
        {
            $model->attributes = $_POST['Categories'];

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
                    @unlink(Yii::app()->basePath . '/www/images/categories/' . $oldFileName);
                    @unlink(Yii::app()->basePath . '/www/images/categories/thumb/' . $oldFileName);

                    $uploader->saveAs(Yii::app()->basePath . '/www/images/categories/' . $fileName);

                    $this->saveThumb($md5_name, $sourcePath['extension']);
                }

                $this->redirect($this->createUrl('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    
    public function actionIndex()
    {
        $model = new Categories('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Categories']))
            $model->attributes = $_GET['Categories'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    private function saveThumb($md5_name, $ext)
    {
        $fileName = $md5_name . '.' . $ext;
        $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/www/images/categories/' . $fileName);

        $dimension = getimagesize(Yii::app()->basePath . '/www/images/categories/' . $fileName);

        $width = $dimension[0];
        $height = $dimension[1];

        if ($width > $height)
        {
            $thumb->cropFromCenter($height);
        }
        else
        {
            $thumb->cropFromCenter($width);
        }
        $thumb->adaptiveResize(200, 200);

        $thumb->save(Yii::app()->basePath . '/www/images/categories/thumb/' . $md5_name . '.' . $ext);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Categories::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'categories-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
