<?php

/**
 * This is the model class for table "drivers_info".
 *
 * The followings are the available columns in table 'drivers_info':
 * @property integer $id
 * @property string $fullname
 * @property string $address
 * @property string $phone
 * @property string $company
 * @property string $company_adress
 * @property integer $company_years
 * @property string $work_history
 * @property string $supervisor_name
 * @property string $supervisor_contact
 * @property integer $worked_from
 * @property integer $worked_to
 * @property string $leaving_reason
 * @property string $position
 * @property string $vehicle
 * @property integer $dependent
 *
 * The followings are the available model relations:
 * @property Users $id0
 */
class DriversInfo extends CActiveRecord
{
    const DRIVER_DEPENDENT = 1;
    const DRIVER_INDEPENDENT = 0;
    
    public $dependence = array(
        self::DRIVER_INDEPENDENT => 'Independent',
        self::DRIVER_DEPENDENT => 'Dependent'
    );

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'drivers_info';
    }

//    protected function beforeSave()
//    {
//        
//    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fullname, address, phone', 'required'),
            array('id, company_years, dependent', 'numerical', 'integerOnly' => true),
            array('fullname, address, phone, company, company_adress, supervisor_name, supervisor_contact, leaving_reason, position, vehicle', 'length', 'max' => 255),
            array('work_history,worked_from,worked_to', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, fullname, address, phone, company, company_adress, company_years, work_history, supervisor_name, supervisor_contact, worked_from, worked_to, leaving_reason, position, vehicle, dependent', 'safe', 'on' => 'search'),
        );
    }

    protected function beforeSave()
    {
        if ($this->worked_from)
        {
            $this->worked_from = strtotime($this->worked_from);
        }
        if ($this->worked_to)
        {
            $this->worked_to = strtotime($this->worked_to);
        }
        if($this->isNewRecord)
        {
            $this->id0->role = Users::ROLE_DRIVER;
            $this->id0->save(false);
        }
        return true;
    }

    protected function afterFind()
    {
        if ($this->worked_from)
        {
            $this->worked_from = date('m/d/Y', $this->worked_from);
        }
        if ($this->worked_to)
        {
            $this->worked_to = date('m/d/Y', $this->worked_to);
        }
        if($this->dependent !=NULL)
        {
            if($this->dependent == self::DRIVER_DEPENDENT)
            {
                $this->dependent = 'Dependent';
            }
            else
            {
                $this->dependent = 'Independent';
            }
        }
        else
        {
            $this->dependent = '';
        }
        return true;
    }

    protected function afterSave()
    {
        $this->addFiles();
        parent::afterSave();
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'id0' => array(self::BELONGS_TO, 'Users', 'id'),
        );
    }

    public function addFiles()
    {
        //If we have pending files
        if (Yii::app()->user->hasState('files'))
        {
            $userFiles = Yii::app()->user->getState('files');
            //Resolve the final path for our files
            $path = Yii::app()->getBasePath() . "/../uploads/drivers_files/{$this->id}/";
            //Create the folder and give permissions if it doesnt exists
            if (!is_dir($path))
            {
                mkdir($path);
                chmod($path, 0777);
            }
            //Now lets create the corresponding models and move the files
            foreach ($userFiles as $file)
            {
                if (is_file($file["path"]))
                {
                    if (rename($file["path"], $path . $file["filename"]))
                    {
                        chmod($path . $file["filename"], 0777);

                        $fil = new DriversFiles();
                        $fil->size = $file["size"];
                        $fil->mime = $file["mime"];
                        $fil->name = $file["name"];
//                        $fil->thumb = "/files/uploads/{$this->id}/thumb/".$file["filename"];
                        $fil->file = $file["filename"];
                        $fil->source = "/uploads/drivers_files/{$this->id}/" . $file["filename"];
                        $fil->users_id = $this->id;
                        if (!$fil->save())
                        {
                            //Its always good to log something
                            Yii::log("Could not save file:\n" . CVarDumper::dumpAsString(
                                            $img->getErrors()), CLogger::LEVEL_ERROR);
                            //this exception will rollback the transaction
                            throw new Exception('Could not save file');
                        }
                    }
                }
                else
                {
                    //You can also throw an execption here to rollback the transaction
                    Yii::log($file["path"] . " is not a file", CLogger::LEVEL_WARNING);
                }
            }
            //Clear the user's session
            Yii::app()->user->setState('files', null);
        }
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'fullname' => 'Fullname',
            'address' => 'Address',
            'phone' => 'Phone',
            'company' => 'Company',
            'company_adress' => 'Company Adress',
            'company_years' => 'Company Years',
            'work_history' => 'Work History',
            'supervisor_name' => 'Supervisor Name',
            'supervisor_contact' => 'Supervisor Contact',
            'worked_from' => 'Worked From',
            'worked_to' => 'Worked To',
            'leaving_reason' => 'Leaving Reason',
            'position' => 'Position',
            'vehicle' => 'Vehicle',
            'dependent' => 'Dependent',
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
        $criteria->compare('fullname', $this->fullname, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('company', $this->company, true);
        $criteria->compare('company_adress', $this->company_adress, true);
        $criteria->compare('company_years', $this->company_years);
        $criteria->compare('work_history', $this->work_history, true);
        $criteria->compare('supervisor_name', $this->supervisor_name, true);
        $criteria->compare('supervisor_contact', $this->supervisor_contact, true);
        $criteria->compare('worked_from', $this->worked_from);
        $criteria->compare('worked_to', $this->worked_to);
        $criteria->compare('leaving_reason', $this->leaving_reason, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('vehicle', $this->vehicle, true);
        $criteria->compare('dependent', $this->dependent);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DriversInfo the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
