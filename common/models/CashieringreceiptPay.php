<?php

/**
 * This is the model class for table "cashieringreceipt_pay".
 *
 * The followings are the available columns in table 'cashieringreceipt_pay':
 * @property integer $id
 * @property integer $cashieringreceipt_id
 * @property integer $trips_id
 *
 * The followings are the available model relations:
 * @property Cashieringreceipt $cashieringreceipt
 * @property Trips $trips
 */
class CashieringreceiptPay extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'cashieringreceipt_pay';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cashieringreceipt_id, trips_id', 'required'),
            array('cashieringreceipt_id, trips_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cashieringreceipt_id, trips_id', 'safe', 'on' => 'search'),
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
            'cashieringreceipt' => array(self::BELONGS_TO, 'Cashieringreceipt', 'cashieringreceipt_id'),
            'trips' => array(self::BELONGS_TO, 'Trips', 'trips_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'cashieringreceipt_id' => 'Cashieringreceipt',
            'trips_id' => 'Trips',
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
        $criteria->compare('cashieringreceipt_id', $this->cashieringreceipt_id);
        $criteria->compare('trips_id', $this->trips_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CashieringreceiptPay the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
