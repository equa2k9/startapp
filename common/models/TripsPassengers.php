<?php

/**
 * This is the model class for table "trips_passengers".
 *
 * The followings are the available columns in table 'trips_passengers':
 * @property integer $id
 * @property integer $trips_id
 * @property integer $passengers_id
 * @property string $pickup_adress
 * @property string $dropoff_adress
 * @property integer $pickup_time
 * @property integer $dropoff_time
 * @property string $google_time
 * @property integer $google_sec
 * @property integer $dropoff_zipcode
 * @property integer $pickup_zipcode
 * @property integer $mileage
 *
 * The followings are the available model relations:
 * @property TripsActivity[] $tripsActivities
 * @property Passengers $passengers
 * @property Trips $trips
 * @property TripsPay[] $tripsPays
 */
class TripsPassengers extends CActiveRecord
{
    public $updateType;  //for dynamic rows in create trip
    public $clients_id;  //in create trip field for dropdown
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'trips_passengers';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('trips_id, passengers_id, pickup_adress, dropoff_adress, clients_id, pickup_time, dropoff_time', 'required'),
            array('trips_id, passengers_id, pickup_time, dropoff_time, google_sec, dropoff_zipcode, pickup_zipcode', 'numerical', 'integerOnly' => true),
            array('pickup_adress, dropoff_adress', 'length', 'max' => 255),
            array('google_time', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, trips_id, passengers_id, pickup_adress, dropoff_adress,mileage, pickup_time, dropoff_time, google_time, google_sec, dropoff_zipcode, pickup_zipcode', 'safe', 'on' => 'search'),
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
            'tripsActivities' => array(self::HAS_MANY, 'TripsActivity', 'trips_passengers_id'),
            'passengers' => array(self::BELONGS_TO, 'Passengers', 'passengers_id'),
            'trips' => array(self::BELONGS_TO, 'Trips', 'trips_id'),
            'tripsPays' => array(self::HAS_MANY, 'TripsPay', 'trips_passengers_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'trips_id' => 'Trips',
            'passengers_id' => 'Passengers',
            'pickup_adress' => 'Pickup Adress',
            'dropoff_adress' => 'Dropoff Adress',
            'pickup_time' => 'Pickup Time',
            'dropoff_time' => 'Dropoff Time',
            'google_time' => 'Google Time',
            'google_sec' => 'Google Sec',
            'dropoff_zipcode' => 'Dropoff Zipcode',
            'pickup_zipcode' => 'Pickup Zipcode',
            'mileage' => 'Mileage',
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
        $criteria->compare('trips_id', $this->trips_id);
        $criteria->compare('passengers_id', $this->passengers_id);
        $criteria->compare('pickup_adress', $this->pickup_adress, true);
        $criteria->compare('dropoff_adress', $this->dropoff_adress, true);
        $criteria->compare('pickup_time', $this->pickup_time);
        $criteria->compare('dropoff_time', $this->dropoff_time);
        $criteria->compare('google_time', $this->google_time, true);
        $criteria->compare('google_sec', $this->google_sec);
        $criteria->compare('dropoff_zipcode', $this->dropoff_zipcode);
        $criteria->compare('pickup_zipcode', $this->pickup_zipcode);
        $criteria->compare('mileage', $this->mileage);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TripsPassengers the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
