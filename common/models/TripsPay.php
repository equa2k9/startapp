<?php

/**
 * This is the model class for table "trips_pay".
 *
 * The followings are the available columns in table 'trips_pay':
 * @property integer $id
 * @property double $driver_fee
 * @property double $payment_due
 * @property double $cc_copay
 * @property double $cash_copay
 * @property double $initial_fee
 * @property double $drop_rate
 * @property double $mileage_rate
 * @property double $deduction
 * @property string $notes
 * @property double $adjusted_fee
 * @property string $notes_waybill
 * @property integer $trips_id
 * @property integer $trips_passengers_id
 *
 * The followings are the available model relations:
 * @property Trips $trips
 * @property TripsPassengers $tripsPassengers
 */
class TripsPay extends CActiveRecord
{
    public $updateType;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'trips_pay';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, trips_id, trips_passengers_id, cc_copay', 'required'),
            array('id, trips_id, trips_passengers_id', 'numerical', 'integerOnly' => true),
            array('driver_fee, payment_due, cc_copay, cash_copay, initial_fee, drop_rate, mileage_rate, deduction, adjusted_fee', 'numerical'),
            array('notes, notes_waybill', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, driver_fee, payment_due, cc_copay, cash_copay, initial_fee, drop_rate, mileage_rate, deduction, notes, adjusted_fee, notes_waybill, trips_id, trips_passengers_id', 'safe', 'on' => 'search'),
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
            'trips' => array(self::BELONGS_TO, 'Trips', 'trips_id'),
            'tripsPassengers' => array(self::BELONGS_TO, 'TripsPassengers', 'trips_passengers_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'driver_fee' => 'Driver Fee',
            'payment_due' => 'Payment Due',
            'cc_copay' => 'Cc Copay',
            'cash_copay' => 'Cash Copay',
            'initial_fee' => 'Initial Fee',
            'drop_rate' => 'Drop Rate',
            'mileage_rate' => 'Mileage Rate',
            'deduction' => 'Deduction',
            'notes' => 'Notes',
            'adjusted_fee' => 'Adjusted Fee',
            'notes_waybill' => 'Notes Waybill',
            'trips_id' => 'Trips',
            'trips_passengers_id' => 'Trips Passengers',
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
        $criteria->compare('driver_fee', $this->driver_fee);
        $criteria->compare('payment_due', $this->payment_due);
        $criteria->compare('cc_copay', $this->cc_copay);
        $criteria->compare('cash_copay', $this->cash_copay);
        $criteria->compare('initial_fee', $this->initial_fee);
        $criteria->compare('drop_rate', $this->drop_rate);
        $criteria->compare('mileage_rate', $this->mileage_rate);
        $criteria->compare('deduction', $this->deduction);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('adjusted_fee', $this->adjusted_fee);
        $criteria->compare('notes_waybill', $this->notes_waybill, true);
        $criteria->compare('trips_id', $this->trips_id);
        $criteria->compare('trips_passengers_id', $this->trips_passengers_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TripsPay the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
