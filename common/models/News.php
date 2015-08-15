<?php

/**
 * This is the model class for table "blog".
 *
 * The followings are the available columns in table 'blog':
 * @property integer $id
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property string $text
 * @property string $picture
 * @property integer $created_at
 */
class News extends CommonActiveRecord
{
    public $modelClass = 'news';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at', 'numerical', 'integerOnly' => true),
            array('title_uk,title_ru,title_en', 'length', 'max' => 255),
           
            array('text,picture, text_uk,text_ru,text_en,alias_url', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title_uk,title_ru,title_en, text_uk,text_ru,text_en, picture, created_at', 'safe', 'on' => 'search'),
        );
    }
    protected function beforeSave() {
        $this->created_at = time();
        return true;
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'picture' => 'Картинка',
            'created_at' => 'Створено',
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
        $criteria->compare('title', $this->title, true);
         $criteria->compare('text', $this->text, true);
        $criteria->compare('picture', $this->picture, true);
        $criteria->compare('created_at', $this->created_at);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Blog the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * 
     * setters and getters to multilanguage
     **/
    
    public function getTitle()
    {
        $attribute = 'title_' . Yii::app()->language;
        return $this->{$attribute};
    }

    public function setTitle($value)
    {
        $attribute = 'title_' . Yii::app()->language;
        $this->{$attribute} = $value;
    }
    public function getText()
    {
        $attribute = 'text_' . Yii::app()->language;
        return $this->{$attribute};
    }

    public function setText($value)
    {
        $attribute = 'text_' . Yii::app()->language;
        $this->{$attribute} = $value;
    }

}
