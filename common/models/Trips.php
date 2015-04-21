<?php

/**
 * This is the model class for table "trips".
 *
 * The followings are the available columns in table 'trips':
 * @property integer $id
 * @property integer $routesheet_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $imported
 *
 * The followings are the available model relations:
 * @property CashieringreceiptPay[] $cashieringreceiptPays
 * @property Comments[] $comments
 * @property Tmptrip[] $tmptrips
 * @property Routesheet $routesheet
 * @property TripsActivity[] $tripsActivities
 * @property TripsInfo $tripsInfo
 * @property TripsPassengers[] $tripsPassengers
 * @property TripsPay[] $tripsPays
 */
class Trips extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'trips';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('routesheet_id, created_at, updated_at', 'required'),
            array('routesheet_id, created_at, updated_at, imported', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, routesheet_id, created_at, updated_at, imported', 'safe', 'on' => 'search'),
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
            'cashieringreceiptPays' => array(self::HAS_MANY, 'CashieringreceiptPay', 'trips_id'),
            'comments' => array(self::HAS_MANY, 'Comments', 'trips_id'),
            'tmptrips' => array(self::HAS_MANY, 'Tmptrip', 'trips_id'),
            'routesheet' => array(self::BELONGS_TO, 'Routesheet', 'routesheet_id'),
            'tripsActivities' => array(self::HAS_MANY, 'TripsActivity', 'trips_id'),
            'tripsInfo' => array(self::HAS_ONE, 'TripsInfo', 'id'),
            'tripsPassengers' => array(self::HAS_MANY, 'TripsPassengers', 'trips_id'),
            'tripsPays' => array(self::HAS_MANY, 'TripsPay', 'trips_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'routesheet_id' => 'Routesheet',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'imported' => 'Imported',
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
        $criteria->compare('routesheet_id', $this->routesheet_id);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('imported', $this->imported);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Trips the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
