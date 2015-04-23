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
            array('id, waybill_id, users_id, status_id, created_at, updated_at, confirmed, from_import', 'safe', 'on' => 'search'),
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

        $criteria->compare('id', $this->id);
        $criteria->compare('waybill_id', $this->waybill_id);
        $criteria->compare('users_id', $this->users_id);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('confirmed', $this->confirmed);
        $criteria->compare('from_import', $this->from_import);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
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

}