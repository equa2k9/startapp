<?php

/**
 * This is the model class for table "routesheet".
 *
 * The followings are the available columns in table 'routesheet':
 * @property integer $id
 * @property integer $waybill_id
 * @property integer $users_id
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $confirmed
 * @property integer $from_import
 *
 * The followings are the available model relations:
 * @property Users $users
 * @property RoutesheetStatus $status
 * @property Trips[] $trips
 * @property Waybill[] $waybills
 */
class Routesheet extends CActiveRecord
{

    public $users_fullname; //for grid filter
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'routesheet';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('waybill_id, users_id, status_id, created_at, updated_at', 'required'),
            array('waybill_id, users_id, status_id, created_at, updated_at, confirmed, from_import', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, waybill_id, users_id, status_id, created_at, updated_at, confirmed,users_fullname, from_import', 'safe', 'on' => 'search'),
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
            'status' => array(self::BELONGS_TO, 'RoutesheetStatus', 'status_id'),
            'trips' => array(self::HAS_MANY, 'Trips', 'routesheet_id'),
            'waybills' => array(self::HAS_MANY, 'Waybill', 'routesheet_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'waybill_id' => 'Waybill',
            'users_id' => 'Users',
            'status_id' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'confirmed' => 'Confirmed',
            'from_import' => 'From Import',
            'users_fullname'=>'Fullname'
        );
    }

    public function scopes()
    {
        parent::scopes();
    }

    /**
     * scope
     */
    public function driverOrAll()
    {
        if (Yii::app()->user->role == Users::ROLE_DRIVER)
        {
            $this->getDbCriteria()->mergeWith(array(
                'condition' => 'users_id=' . Yii::app()->user->id
            ));
        }
        return $this;
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
        $criteria->with = array('status', 'users.driversInfo' => array('select' => 'fullname'));
        if(isset($this->id))
        {
            $criteria->compare('t.id', $this->id);
        }
        if(isset($this->waybill_id))
        {
            $criteria->compare('t.waybill_id', $this->waybill_id);
        }
        if(isset($this->users_fullname))
        {
            $criteria->compare('driversInfo.fullname', $this->users_fullname, true);
        }
        if(isset($this->status_id))
        {
            $criteria->compare('t.status_id', $this->status_id);
        }
        if(isset($this->created_at))
        {
            $criteria->compare('t.created_at', $this->created_at);
        }
        if(isset($this->updated_at))
        {
            $criteria->compare('t.updated_at', $this->updated_at);
        }
//        $criteria->compare('confirmed', $this->confirmed);
//        $criteria->compare('from_import', $this->from_import);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => array(
                'defaultOrder' => 't.id DESC',
                'attributes' => array(
                    'users_fullname' => array(
                        'asc' => 'driversInfo.fullname',
                        'desc' => 'driversInfo.fullname DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Routesheet the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function afterFind()
    {
        $this->created_at = date('m/d/Y h:i:s A', $this->created_at);
        $this->updated_at = date('m/d/Y h:i:s A', $this->updated_at);
        if ($this->waybill_id == 0)
        {
            $this->waybill_id = 'Not generated';
        }
        parent::afterFind();
    }

}
