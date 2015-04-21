<?php

/**
 * This is the model class for table "trips_activity".
 *
 * The followings are the available columns in table 'trips_activity':
 * @property integer $id
 * @property integer $trips_id
 * @property integer $users_id
 * @property integer $trips_passengers_id
 * @property integer $status_id
 * @property integer $time
 *
 * The followings are the available model relations:
 * @property TripsPassengers $tripsPassengers
 * @property Trips $trips
 * @property TripsStatus $status
 * @property Users $users
 */
class TripsActivity extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'trips_activity';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('trips_id, users_id, trips_passengers_id, status_id, time', 'required'),
            array('trips_id, users_id, trips_passengers_id, status_id, time', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, trips_id, users_id, trips_passengers_id, status_id, time', 'safe', 'on' => 'search'),
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
            'tripsPassengers' => array(self::BELONGS_TO, 'TripsPassengers', 'trips_passengers_id'),
            'trips' => array(self::BELONGS_TO, 'Trips', 'trips_id'),
            'status' => array(self::BELONGS_TO, 'TripsStatus', 'status_id'),
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
            'trips_id' => 'Trips',
            'users_id' => 'Users',
            'trips_passengers_id' => 'Trips Passengers',
            'status_id' => 'Status',
            'time' => 'Time',
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
        $criteria->compare('users_id', $this->users_id);
        $criteria->compare('trips_passengers_id', $this->trips_passengers_id);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('time', $this->time);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TripsActivity the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
