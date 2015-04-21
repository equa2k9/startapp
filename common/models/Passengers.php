<?php

/**
 * This is the model class for table "passengers".
 *
 * The followings are the available columns in table 'passengers':
 * @property integer $id
 * @property integer $clients_id
 * @property string $name
 * @property string $phone
 * @property integer $email
 * @property integer $pickup_number
 * @property integer $dropoff_number
 *
 * The followings are the available model relations:
 * @property Clients $clients
 * @property TripsPassengers[] $tripsPassengers
 */
class Passengers extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'passengers';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('clients_id, name', 'required'),
            array('clients_id, email, pickup_number, dropoff_number', 'numerical', 'integerOnly' => true),
            array('name, phone', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, clients_id, name, phone, email, pickup_number, dropoff_number', 'safe', 'on' => 'search'),
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
            'clients' => array(self::BELONGS_TO, 'Clients', 'clients_id'),
            'tripsPassengers' => array(self::HAS_MANY, 'TripsPassengers', 'passengers_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'clients_id' => 'Clients',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'pickup_number' => 'Pickup Number',
            'dropoff_number' => 'Dropoff Number',
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
        $criteria->compare('clients_id', $this->clients_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email);
        $criteria->compare('pickup_number', $this->pickup_number);
        $criteria->compare('dropoff_number', $this->dropoff_number);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Passengers the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
