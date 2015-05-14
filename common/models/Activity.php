<?php

/**
 * This is the model class for table "activity".
 *
 * The followings are the available columns in table 'activity':
 * @property integer $id
 * @property integer $users_id
 * @property integer $login
 * @property integer $logout
 *
 * The followings are the available model relations:
 * @property Users $users
 */
class Activity extends CActiveRecord
{
    /**
     * date
     * @var $dateFrom
     */
    public $dateFrom;

    /**
     * date
     * @var $dateTo
     */
    public $dateTo;

    /**
     * date
     * @var $dateFromO
     */
    public $dateFromO;

    /**
     *
     * @var date $dateToO
     */
    public $dateToO;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'activity';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('users_id, login, logout', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, users_id, dateToO, dateTo, dateFromO, dateFrom, login, logout', 'safe', 'on' => 'search'),
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
            'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'users_id' => 'Users',
            'login' => 'Login',
            'logout' => 'Logout',
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
        $dateF = strtotime($this->dateFrom);
        $dateT = strtotime($this->dateTo);
        $dateFoO = strtotime($this->dateFromO);
        $dateToO = strtotime($this->dateToO);

        $criteria = new CDbCriteria;

        if (!empty($this->id))
        {
            $criteria->compare('id', $this->id);
        }
        $criteria->compare('users_id', $this->users_id);
        if (!empty($this->dateFrom) && (!empty($this->dateTo) && ($this->dateTo == $this->dateFrom)))
        {
            $dat = strtotime($this->dateTo . " 23:59:59");
            $criteria->addCondition("login >= '$dateF' AND login <= '$dat'");
        }
        if (!empty($this->dateFrom) && (!empty($this->dateTo) && ($this->dateTo != $this->dateFrom)))
        {
            $criteria->addCondition("login >= '$dateF' AND login <= '$dateT'");
        }
        if (empty($this->dateFrom) && (!empty($this->dateTo)))
        {
            $criteria->addCondition("login <= '$dateT'");
        }
        if (!empty($this->dateFrom) && (empty($this->dateTo)))
        {
            $criteria->addCondition("login >= '$dateF'");
        }

        if (!empty($this->dateFromO) && (!empty($this->dateToO) && ($this->dateToO == $this->dateFromO)))
        {

            $criteria->compare("logout", strtotime($this->dateToO));
        }
        if (!empty($this->dateFromO) && (!empty($this->dateToO) && ($this->dateToO != $this->dateFromO)))
        {
            $criteria->addCondition("logout >= '$dateFoO' AND logout <= '$dateToO'");
        }
        if (empty($this->dateFromO) && (!empty($this->dateToO)))
        {
            $criteria->addCondition("logout <= '$dateToO'");
        }
        if (!empty($this->dateFromO) && (empty($this->dateToO)))
        {
            $criteria->addCondition("logout >= '$dateFoO'");
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => array('id' => 'DESC')),
            'pagination' => false
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Activity the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * id of user
     * type of of action
     * @param $id
     * @param $type
     */
    public static function logUser($id, $type = true)
    {
        if ($type)
        {
            $model = new Activity();
            $model->users_id = $id;
            $model->login = time();
        }
        else
        {
            $criteria = new CDbCriteria();
            $criteria->order = 'id DESC';
            $criteria->compare('users_id', Yii::app()->user->id, false);

            $model = self::model()->find($criteria);
            $model->logout = time();
        }

        $model->save(false);

    }

}
