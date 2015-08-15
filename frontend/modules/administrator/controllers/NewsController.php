<?php

class NewsController extends AdministratorController {

    public function actions() {
        return array(
            'delete' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'News',
            ),
        );
    }

    public function actionCreate()
    {
        $model = new News;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];
            $uploader = CUploadedFile::getInstance($model, 'picture');

            $model->attributes = $_POST['News'];

            if ($uploader)
            {
                $sourcePath = pathinfo($uploader->getName());

                $md5_name = md5(date('H:i:s'));

                $fileName = $md5_name . '.' . $sourcePath['extension']; //generate new filename

                $model->picture = $fileName;
//                $model->sort = News::model()->count() + 1;
                if ($model->save())
                {
                    if ($uploader)
                    {
                        $uploader->saveAs(Yii::app()->basePath . '/www/images/news/' . $fileName);

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

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        $oldFileName = $model->picture;
        if (isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];

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
                    
                    @unlink(Yii::app()->basePath . '/www/images/news/' . $oldFileName);
                    @unlink(Yii::app()->basePath . '/www/images/news/thumb/' . $oldFileName);

                    $uploader->saveAs(Yii::app()->basePath . '/www/images/news/' . $fileName);

//                    $this->saveThumb($md5_name, $sourcePath['extension']);
                }

                $this->redirect($this->createUrl('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    
    private function saveThumb($md5_name, $ext)
    {
        $fileName = $md5_name . '.' . $ext;
        $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/www/images/news/' . $fileName);

        $dimension = getimagesize(Yii::app()->basePath . '/www/images/news/' . $fileName);

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

        $thumb->save(Yii::app()->basePath . '/www/images/news/thumb/' . $md5_name . '.' . $ext);
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new News('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['News']))
            $model->attributes = $_GET['News'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = News::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
