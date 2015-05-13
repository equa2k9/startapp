<?php

/**
 * This is the model class for table "drivers_comments".
 *
 * The followings are the available columns in table 'drivers_comments':
 * @property integer $id
 * @property integer $users_id
 * @property integer $leave_comment_id
 * @property string $message
 * @property integer $created_at
 *
 * The followings are the available model relations:
 * @property Users $leaveComment
 * @property Users $users
 */
class DriversComments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'drivers_comments';
	}
    protected function beforeSave()
    {
        if($this->created_at)
        {
            $this->created_at = time();
        }
        return true;
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, leave_comment_id', 'required'),
			array('users_id, leave_comment_id, created_at', 'numerical', 'integerOnly'=>true),
			array('message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, users_id, leave_comment_id, message, created_at', 'safe', 'on'=>'search'),
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
			'leaveComment' => array(self::BELONGS_TO, 'Users', 'leave_comment_id'),
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
			'leave_comment_id' => 'Leave Comment',
			'message' => 'Message',
			'created_at' => 'Created At',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('leave_comment_id',$this->leave_comment_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created_at',$this->created_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DriversComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
