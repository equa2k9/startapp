<?php

/**
 * This is the model class for table "drivers_rate".
 *
 * The followings are the available columns in table 'drivers_rate':
 * @property integer $id
 * @property integer $users_id
 * @property integer $client_id
 * @property double $rate
 * @property double $percentage
 *
 * The followings are the available model relations:
 * @property Clients $client
 * @property Users $users
 */
class DriversRate extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'drivers_rate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('users_id, client_id', 'required'),
            array('users_id, client_id', 'numerical', 'integerOnly' => true),
            array('rate, percentage', 'numerical'),
            array('rate', 'required', 'on' => 'rate'),
            array('percentage', 'required', 'on' => 'percentage'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, users_id, client_id, rate, percentage', 'safe', 'on' => 'search'),
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
            'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
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
            'client_id' => 'Client',
            'rate' => 'Rate',
            'percentage' => 'Percentage',
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
    public function search($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'users_id = ' . $id;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DriversRate the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function deleteRates($id)
    {
        if (self::model()->deleteAllByAttributes(array('users_id' => $id)))
        {
            return true;
        }
        return false;
    }

    public function viewDriver($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'users_id = ' . $id;
//        $criteria->compare('users_id',$id,false);
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

}
