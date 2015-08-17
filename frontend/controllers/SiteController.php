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
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        $dataProvider = new CActiveDataProvider('News');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
    public function actionAbout()
    {
        $this->render('about');
    }
    public function actionDelivery()
    {
        $this->render('delivery');
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

        if (Yii::app()->request->isPostRequest)
        {
            $model->attributes = Yii::app()->request->getPost('ContactForm');
            if ($model->validate())
            {
                $mail = new YiiMailer('contact', array('message' => $model->body, 'name' => $model->name, 'phone' => $model->phone, 'description' => Yii::t('site', 'Contact form')));
                $mail->setFrom($model->email, $model->name);
                $mail->setSubject(Yii::t('site', 'Контактная форма'));
                $mail->setTo('jek3211@gmail.com');
                if ($mail->send())
                {
                    Yii::app()->user->setFlash('success', Yii::t('site', 'Thank you for contacting us. We will respond to you as soon as possible.'));
                    $this->refresh();
                }
                else
                {
                    Yii::app()->user->setFlash('danger', Yii::t('site', 'Something went wrong, please, try again later'));
                }
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
        if (Yii::app()->request->isPostRequest)
        {
            $model->attributes = Yii::app()->request->getPost('LoginForm');
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

        if (Yii::app()->request->isPostRequest)
        {
            $model->attributes = Yii::app()->request->getPost('Users');
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

        Yii::app()->user->logout();
        Yii::app()->session->clear();
        $this->redirect(Yii::app()->homeUrl);
    }

}
