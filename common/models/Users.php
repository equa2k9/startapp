<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $role
 * @property string $email
 * @property integer $is_activated
 * @property string $hash_link
 * @property integer $created_at
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property Cashieringreceipt[] $cashieringreceipts
 * @property Comments[] $comments
 * @property DriversFiles[] $driversFiles
 * @property DriversInfo $driversInfo
 * @property DriversRate[] $driversRates
 * @property Routesheet[] $routesheets
 * @property Tmptrip[] $tmptrips
 * @property TripsActivity[] $tripsActivities
 */
class Users extends CActiveRecord
{

    public $image; //for upload avatar
    public $userPassword; //password input
    public $userPasswordRe; //re-type password
    public $oldPassword; //for change password
    public $skype;
    public $fullname;
    public $phone;

    /*
     * ROLES of users
     */

    const ROLE_ADMIN = 'administrator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';

    /*
     * Activated driver or not
     */
    const IS_ACTIVATED = 1;
    const IS_NOT_ACTIVATED = 0;

    /*
     * Return current authenticated user
     */

    static private $currentAuthUser = null;

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

    protected function beforeSave()
    {
        /**
         * set password and password hash
         * set role
         * save image
         * make hashlink to confirm registration
         */
        if ($this->getScenario() == 'registration')
        {
            $images_path = Yii::getPathOfAlias('uploads');
            $this->password_hash = self::generateSalt();
            $this->password = crypt($this->userPassword, $this->password_hash);
            $this->role = self::ROLE_USER;
            $this->image->saveAs($images_path . '/avatars/' . $this->image);
            $this->photo = $this->image;
            $this->hash_link = uniqid("", false);
            $this->created_at = time();
        }
//        if ($this->getScenario() == 'confirm')
//        {
//            
//        }
        if ($this->getScenario() == 'changepassword')
        {
            $this->password_hash = self::generateSalt();
            $this->password = crypt($this->userPassword, $this->password_hash);
        }
        return true;
    }

    protected function afterSave()
    {
        /**
         * send mail with hash link
         */
        if ($this->getScenario() == 'registration')
        {
            Yii::app()->sendConfirmMail('registration', $this, Yii::t('site', 'Jazz-Acoustics'));
            return true;
        }
        parent::afterSave();
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('username,userPassword,userPasswordRe,email', 'required', 'on' => 'registration'),
            array('image', 'file', 'types' => 'jpg, jpeg, gif, png', 'on' => 'registration'),
            array('userPasswordRe', 'compare', 'compareAttribute' => 'userPassword', 'on' => 'registration'),
            array('email', 'email', 'on' => 'registration'),
            array('email', 'unique', 'attributeName' => 'email', 'className' => 'Users', 'enableClientValidation' => true, 'on' => 'registration'),
            array('username', 'unique', 'attributeName' => 'username', 'className' => 'Users', 'enableClientValidation' => true, 'on' => 'registration'),
            array('id, username,skype,phone,is_activated,dependent,email,fullname', 'safe', 'on' => 'search,searchforms'),
            array('image,skype,role', 'safe'),
            array('hash_link', 'safe', 'on' => 'confirm'),
            //rules for change password
            array('oldPassword','required','on'=>'changepassword'),
            array('userPasswordRe',
                'compare',
                'compareAttribute' => 'userPassword',
                'on' => 'changepassword',
                'enableClientValidation' => true,
            ),
            array('userPassword',
                'compare',
                'compareAttribute' => 'oldPassword',
                'enableClientValidation' => true,
                'on' => 'changepassword',
                'operator' => '!=',
                'message' => '{attribute} must not be equal to Old Password'
            ),
            array('oldPassword', 'checkOldPassword', 'on' => 'changepassword'), //validation if new password are not the same as old
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
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
            'username' => Yii::t('site', 'Username'),
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

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
//        $criteria->with = array('driversInfo','driversRates');
//        $criteria->scopes = array('all_drivers', 'activated');
//        $criteria->with = array('driversInfo');

        if (isset($this->id))
        {
            $criteria->compare('t.id', $this->id);
        }
        if (isset($this->fullname))
        {
//            $criteria->compare('driversInfo.fullname', $this->fullname, true);
        }
        if (isset($this->email))
        {
            $criteria->compare('t.email', $this->email, true);
        }
        if (isset($this->created_at))
        {
            $criteria->compare('t.created_at', $this->created_at);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => array(
                'defaultOrder' => 't.id DESC',
                'attributes' => array(
//                    'fullname' => array(
//                        'asc' => 'driversInfo.fullname',
//                        'desc' => 'driversInfo.fullname DESC',
//                    ),
//                    'dependent' => array(
//                        'asc' => 'driversInfo.dependent',
//                        'desc' => 'driversInfo.dependent DESC',
//                    ),
                    '*',
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function scopes()
    {
        return array(
            'activated' => array(
                'condition' => 'is_activated =' . self::IS_ACTIVATED
            ),
            'not_activated' => array(
                'condition' => 'is_activated =' . self::IS_NOT_ACTIVATED
            ),
        );
    }

    /**
     * return username by id
     * @param int $id
     * @return string
     */
    public static function getUsername($id)
    {
        if ($id != null)
        {
            $model = self::model()->findByPk($id);

            return $model->username;
        }
        else
        {
            return Yii::t('site', 'Guest');
        }
    }

    /**
     * return id by username
     * @param string $username
     * @return int
     */
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

    /**
     * return $model by email
     * @param string $email
     * @return $model
     */
    public function findByEmail($email)
    {
        return self::model()->findByAttributes(array('email' => $email));
    }

    protected static function generateSalt()
    {
        return uniqid('', true);
    }

    /**
     * validation rule to check old password
     */
    public function checkOldPassword($attribute, $params)
    {
        $user = self::current();

        if ($user)
        {
            if ($user->password !== crypt($this->oldPassword, $user->password_hash))
            {
                $this->addError($attribute, "You type wrong password");
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

//    /**
//     * enroll this driver
//     * @return bool
//     */
//    public function activateDriver()
//    {
//        $this->is_activated = self::IS_ACTIVATED;
//        Yii::app()->sendConfirmMail('activedriver', $this, 'Driver profile is activated');
//        $this->save(false);
//
//        return true;
//    }
//    /**
//     *
//     * @return bool
//     */
//    public function deactivateDriver()
//    {
//        $this->is_activated = self::IS_NOT_ACTIVATED;
//        $this->save(false);
//
//        return true;
//    }
}
