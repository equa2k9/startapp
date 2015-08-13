<?php

class ArticlesController extends AdministratorController {

    public function actions() {
        return array(
            'upload' => array(
                'class' => 'xupload.actions.XUploadAction',
                'path' => Yii::app()->getBasePath() . "/www/images/catalog",
                'publicPath' => Yii::app()->getBaseUrl() . "/www/images/catalog",
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        
        $model = new Articles;
        Yii::import("xupload.models.XUploadForm");
        $files = new XUploadForm();

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Articles'])) {
            $model->attributes = $_POST['Articles'];
            if ($model->save())
            {
                $model->articlesPictures->save();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'files'=>$files
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id)->with('articlesPictures');
        Yii::import("xupload.models.XUploadForm");
        $files = new XUploadForm();
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Articles'])) {
            $model->attributes = $_POST['Articles'];
            if ($model->save())
            {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'files'=>$files
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Articles('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Articles']))
            $model->attributes = $_GET['Articles'];

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
        $model = Articles::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'articles-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionUpload()
    {
        Yii::import("xupload.models.XUploadForm");
        
        //Here we define the paths where the files will be stored temporarily
        $path = realpath(Yii::app()->getBasePath() . "/www/images/catalog/tmp") . "/";
        $publicPath = Yii::app()->getBaseUrl() . "/www/images/catalog/tmp/";
        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
        {
            header('Content-type: application/json');
        }
        else
        {
            header('Content-type: text/plain');
        }
        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"]))
        {
            if ($_GET["_method"] == "delete")
            {
                if (isset($_GET["file"]) && $_GET["file"][0] !== '.')
                {
                    $file = $path . $_GET["file"];
                    if (is_file($file))
                    {
                        unlink($file);
                    }
                }
                elseif ($_GET["id"])
                {
                    $delImage = ArticlesPictures::model()->findByPk($_GET["id"]);
                    if ($delImage)
                    {
                        if (is_file(realpath(Yii::app()->getBasePath() . '/..' . $delImage->source)))
                        {
                            @unlink(realpath(Yii::app()->getBasePath() . '/..' . $delImage->source));
//                            @unlink(realpath(Yii::app()->getBasePath().'/..'.$delImage->thumb));
                            $delImage->delete(false);
                        }
                    }
                }
                echo json_encode(true);
            }
            elseif ($_GET["_method"] == "list")
            {
                
                $article_id = $_GET['id'];
                $objProductImages = ArticlesPictures::model()->findAllByAttributes(array('article_id' => $article_id));
                if ($objProductImages !== null)
                {
                    $arrProductImages = array();
                    foreach ($objProductImages as $objProductImage)
                    {
                        $arrProductImages[] = array(
                            "name" => $objProductImage->name,
                            "id" => $objProductImage->getPrimaryKey(),
                            "type" => $objProductImage->mime,
                            "size" => $objProductImage->size,
                            "url" => $objProductImage->source,
//                            "thumbnail_url" => $objProductImage->thumb,
                            "delete_url" => $this->createUrl("upload", array("_method" => "delete", "id" => $objProductImage->id)),
                            "delete_type" => "GET",
                        );
                    }
                    echo json_encode($arrProductImages);
                }
            }
        }
        else
        {
            $model = new XUploadForm();
            $model->file = CUploadedFile::getInstance($model, 'file');
            //We check that the file was successfully uploaded
            if ($model->file !== null)
            {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id . microtime() . $model->name);
                $filename .= "." . $model->file->getExtensionName();
                if ($model->validate())
                {
                    //Move our file to our temporary dir
                    $model->file->saveAs($path . $filename);
                    chmod($path . $filename, 0777);
                    //here you can also generate the image versions you need
                    //using something like PHPThumb
                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState('files'))
                    {
                        $userImages = Yii::app()->user->getState('files');
                    }
                    else
                    {
                        $userImages = array();
                    }
                    $userImages[] = array(
                        "path" => $path . $filename,
                        //the same file or a thumb version that you generated
//                        "thumb" => $path."thumbs/".$filename,
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                    );
                    Yii::app()->user->setState('files', $userImages);
                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $filename,
//                            "thumbnail_url" => $publicPath."thumbs/$filename",
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $filename,
                            )),
                            "delete_type" => "POST",
                    )));
                }
                else
                {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                        ),));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            }
            else
            {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

}
