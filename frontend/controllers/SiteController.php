<?php

class SiteController extends FrontendSiteController
{

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
                'actions' => array('*'),
                'users' => array('*'),
            ),
            array('deny',
                'actions' => array('registration', 'login', 'confirm'),
                'users' => array('@'),
                'deniedCallback' => function () {
            Yii::app()->controller->redirect(Yii::app()->createUrl('site/index'));
        },
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate())
            {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
            {
                if (Yii::app()->user->role == Users::ROLE_USER)
                {
                    $role = Yii::app()->user->role . 's';
                }
                else
                {
                    $role = Yii::app()->user->role;
                }
                Activity::logUser(Yii::app()->user->id);
                $this->redirect('/' . $role . '/');
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionRegistration()
    {
        $model = new Users('registration');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-registration-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Users']))
        {
            $model->attributes = $_POST['Users'];
            $model->image = CUploadedFile::getInstance($model, 'image');
            if ($model->validate())
            {
                if ($model->save())
                {
                    Yii::app()->user->setFlash('success', Yii::t('site', 'You registration was success, please check your e-mail for confirm link'));
                    $this->redirect('login');
                }
                else
                {
                    Yii::app()->user->setFlash('error', Yii::t('site', 'Sorry, something went wrong, try again later.'));
                    $this->refresh();
                }
            }
        }
        $this->render('registration', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Activity::logUser(Yii::app()->user->id, false);
        Yii::app()->user->logout();
        Yii::app()->session->clear();
        $this->redirect(Yii::app()->homeUrl);
    }

}
