<?php

class DashboardController extends ModuleController
{

    public function actions()
    {
        return array(
            'upload' => array(
                'class' => 'xupload.actions.XUploadAction',
                'path' => Yii::app()->getBasePath() . "/../uploads",
                'publicPath' => Yii::app()->getBaseUrl() . "/uploads",
            ),
        );
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {

        return array(
            array('allow', // allow all users to perform the 'login' action
                'actions' => array('error'),
                'users' => array('*'),
            ),
            array('deny',
                'actions' => array('driverForm'),
                'expression' => 'Yii::app()->user->role !="user"&&Yii::app()->user->role !="driver"',
            ),
            array('allow', // allow authenticated users to access all actions
                'roles' => array('user'),
            ),
            array('deny'),
        );
    }

    public function actionIndex()
    {
        $model = Users::current();
        $model->scenario = 'updateuser';

        $this->render('index', array('model' => $model));
    }

    public function actionChangePassword()
    {
        $password = Users::current();
        $password->scenario = 'changepassword';
        if (Yii::app()->request->isPostRequest)
        {
            $password->oldPassword = $_POST['Users']['oldPassword'];
            $password->userPassword = $_POST['Users']['userPassword'];
            $password->userPasswordRe = $_POST['Users']['userPasswordRe'];

            if ($password->validate())
            {
                $password->save();
                Yii::app()->user->setFlash('success', Yii::t('site', 'Your password has been changed successfuly'));
                $this->refresh();
            }
        }
        $this->render('password', array('password' => $password));
    }

    public function getMenu()
    {
        $role = Yii::app()->user->role;
        return $this->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/users',
            ),
            array('label' => 'Change password', 'url' => '/users/dashboard/changePassword'),
            array('label' => 'Driver form', 'url' => '/users/dashboard/driverForm'),
            array('label' => ucfirst($role) . ' dashboard', 'url' => '/' . $role),
        );
    }

    /**
     * action to update default user information
     * @return boolean in ajax
     */
    public function actionUpdateUser()
    {
        $model = Users::current();

        $model->setScenario('updateuser');
        try
        {
            if (Yii::app()->request->isPostRequest)
            {
                $model->attributes = $_POST;
//                if ($_POST['name'] == 'userPassword')
//                    $model->phone = $_POST['value'];

                $model->save();
            }
        }
        catch (CException $e)
        {
            echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
            return;
        }
        echo CJSON::encode(array('success' => true));
    }

    /**
     * action for driver form
     */
    public function actionDriverForm()
    {
        $model = Users::model()->with('driversInfo', 'driversFiles')->current();
        Yii::import("xupload.models.XUploadForm");
        $files = new XUploadForm();
        if (!$model->driversInfo)
        {
            $model->driversInfo = new DriversInfo();
        }
        if (Yii::app()->request->isPostRequest)
        {
            $model->driversInfo->attributes = $_POST['DriversInfo'];
            $model->driversInfo->id = $model->id;
            if ($model->driversInfo->validate())
            {
                $model->driversInfo->save();
                Yii::app()->user->setFlash('success', Yii::t('site', 'Your drivers info has been changed successfuly'));
                $this->refresh();
            }
        }
        $this->render('driverform', array('model' => $model, 'files' => $files));
    }

    public function actionUpload()
    {
        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = realpath(Yii::app()->getBasePath() . "/../uploads/drivers_files/tmp") . "/";
        $publicPath = Yii::app()->getBaseUrl() . "/uploads/drivers_files/tmp/";
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
                    $delImage = DriversFiles::model()->findByPk($_GET["id"]);
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
                $users_id = $_GET['id'];
                $objProductImages = DriversFiles::model()->findAllByAttributes(array('users_id' => $users_id));
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
