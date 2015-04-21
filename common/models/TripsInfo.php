<?php

/**
 * This is the model class for table "trips_info".
 *
 * The followings are the available columns in table 'trips_info':
 * @property integer $id
 * @property integer $type
 * @property integer $contractor_id
 * @property string $attachment
 * @property string $comment
 * @property integer $will_call
 * @property integer $from_import
 * @property string $service_area
 * @property string $fare
 * @property integer $confirmation_number
 * @property integer $exception_type
 * @property string $provider_name
 * @property string $dob
 * @property string $mid
 * @property integer $trip_leg_id
 *
 * The followings are the available model relations:
 * @property Contractor $contractor
 * @property Trips $id0
 */
class TripsInfo extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'trips_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, contractor_id', 'required'),
            array('id, type, contractor_id, will_call, from_import, confirmation_number, exception_type, trip_leg_id', 'numerical', 'integerOnly' => true),
            array('attachment', 'length', 'max' => 255),
            array('service_area, fare, provider_name, dob, mid', 'length', 'max' => 50),
            array('comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, contractor_id, attachment, comment, will_call, from_import, service_area, fare, confirmation_number, exception_type, provider_name, dob, mid, trip_leg_id', 'safe', 'on' => 'search'),
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
            'contractor' => array(self::BELONGS_TO, 'Contractor', 'contractor_id'),
            'id0' => array(self::BELONGS_TO, 'Trips', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'contractor_id' => 'Contractor',
            'attachment' => 'Attachment',
            'comment' => 'Comment',
            'will_call' => 'Will Call',
            'from_import' => 'From Import',
            'service_area' => 'Service Area',
            'fare' => 'Fare',
            'confirmation_number' => 'Confirmation Number',
            'exception_type' => 'Exception Type',
            'provider_name' => 'Provider Name',
            'dob' => 'Dob',
            'mid' => 'Mid',
            'trip_leg_id' => 'Trip Leg',
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
        $criteria->compare('type', $this->type);
        $criteria->compare('contractor_id', $this->contractor_id);
        $criteria->compare('attachment', $this->attachment, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('will_call', $this->will_call);
        $criteria->compare('from_import', $this->from_import);
        $criteria->compare('service_area', $this->service_area, true);
        $criteria->compare('fare', $this->fare, true);
        $criteria->compare('confirmation_number', $this->confirmation_number);
        $criteria->compare('exception_type', $this->exception_type);
        $criteria->compare('provider_name', $this->provider_name, true);
        $criteria->compare('dob', $this->dob, true);
        $criteria->compare('mid', $this->mid, true);
        $criteria->compare('trip_leg_id', $this->trip_leg_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TripsInfo the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
