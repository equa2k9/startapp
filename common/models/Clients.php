<?php

/**
 * This is the model class for table "clients".
 *
 * The followings are the available columns in table 'clients':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property integer $created_at
 *
 * The followings are the available model relations:
 * @property ClientsRate $clientsRate
 * @property DriversRate[] $driversRates
 * @property Passengers[] $passengers
 */
class Clients extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'clients';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, created_at', 'required'),
            array('created_at', 'numerical', 'integerOnly' => true),
            array('name, phone, email', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, phone, email, created_at', 'safe', 'on' => 'search'),
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
            'clientsRate' => array(self::HAS_ONE, 'ClientsRate', 'id'),
            'driversRates' => array(self::HAS_MANY, 'DriversRate', 'client_id'),
            'passengers' => array(self::HAS_MANY, 'Passengers', 'clients_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'created_at' => 'Created At',
        );
    }

    protected function afterFind()
    {
        if($this->created_at)
        {
            $this->created_at = date('m/d/Y h:i:s A',$this->created_at);
        }
        return parent::afterFind();
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('created_at', $this->created_at);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Clients the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @param int
     * find all clients to dropdown in drivers rate
     * excluded client that has rates for current driver
     * @return array
     */
    public static function getClients($users_id)
    {

        $data = array();
        $rateArray = array();
        $rateCriteria = new CDbCriteria();
        $rateCriteria->distinct = true;
        $rateCriteria->select = 'client_id';
        $rateCriteria->compare('users_id', $users_id, false);
        $rates = DriversRate::model()->findAll($rateCriteria);

        foreach ($rates as $rate)
        {
            $rateArray[] = $rate->client_id;
        }
        $criteria = new CDbCriteria();
        $criteria->select = array('id, name');
        $criteria->addNotInCondition('id', $rateArray);

        if ($model = self::model()->findAll($criteria))
        {

            foreach ($model as $value)
            {
                $data[$value->id] = $value->name;
            }
        }
        return $data;
    }

}
