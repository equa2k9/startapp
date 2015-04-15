<?php

class Users extends CActiveRecord
{

    public $image;
    public $userPassword;
    public $userPasswordRe;

    const ROLE_ADMIN = 'administrator';
    const ROLE_MODER = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';
    const IS_ACTIVATED = 1;
    const IS_NOTACTIVATED = 0;

    static private $currentAuthUser = null;

    // some code
    static public function current()
    {
        if (Yii::app()->user->isGuest)
        {
            return new self();
        }
        if (is_null(self::$currentAuthUser))
        {
            self::$currentAuthUser = self::model()->findByPk(
                    Yii::app()->user->getId()
            );
        }
        return self::$currentAuthUser;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return array(
            array('username,userPassword,userPasswordRe,email', 'required', 'on' => 'registration'),
            array('image', 'file', 'types' => 'jpg, jpeg, gif, png', 'on' => 'registration'),
            array('userPasswordRe', 'compare', 'compareAttribute' => 'userPassword', 'on' => 'registration'),
            array('email', 'email', 'on' => 'registration'),
            array('email', 'unique', 'attributeName' => 'email', 'className' => 'Users', 'enableClientValidation' => true, 'on' => 'registration'),
            array('username', 'unique', 'attributeName' => 'username', 'className' => 'Users', 'enableClientValidation' => true, 'on' => 'registration'),
            array('id, username,skype,phone', 'safe', 'on' => 'search'),
            array('phone, skype,image,role,is_activated', 'safe', 'on' => 'updateuser'),
        );
    }

    public function relations()
    {
        return array(
            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => Yii::t('site', 'Login'),
            'password' => Yii::t('site', 'Password'),
            'password_hash' => 'Password Hash',
            'role' => 'Role',
            'email' => 'Email',
            'photo' => Yii::t('site', 'Photo'),
            'image' => Yii::t('site', 'Photo'),
            'phone' => Yii::t('site', 'Phone'),
            'skype' => Yii::t('site', 'Skype'),
            'userPassword' => Yii::t('site', 'Password'),
            'userPasswordRe' => Yii::t('site', 'Re-enter password'),
        );
    }

    public static function getUsername($id)
    {
        if ($id != null)
        {
            $model = self::model()->findByPk($id);

            return $model->username;
        }
        else
        {
            return Yii::t('site', 'Anonymous');
        }
    }

    public static function getId($username)
    {
        if ($username != null)
        {
            $model = self::model()->findByAttributes(array('username' => $username));
            if ($model)
            {
                return $model->id;
            }
            else
            {
                return;
            }
        }
        else
        {
            return;
        }
    }

    public function search()
    {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('skype', $this->skype, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function findByEmail($email)
    {
        return self::model()->findByAttributes(array('email' => $email));
    }

}
