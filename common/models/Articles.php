<?php

/**
 * This is the model class for table "articles".
 *
 * The followings are the available columns in table 'articles':
 * @property integer $id
 * @property integer $category_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $name_en
 * @property string $description_uk
 * @property string $description_en
 * @property string $description_ru
 * @property string $alias_url
 * @property integer $sort
 *
 * The followings are the available model relations:
 * @property Categories $category
 * @property ArticlesPictures[] $articlesPictures
 */
class Articles extends CommonActiveRecord
{
    public $picture;
    public $modelClass='catalog';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'articles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, alias_url', 'required'),
            array('category_id, sort', 'numerical', 'integerOnly' => true),
            array('name_uk, name_ru, name_en, alias_url', 'length', 'max' => 50),
            array('description_uk, description_en, description_ru', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, category_id, name_uk, name_ru, name_en, description_uk, description_en, description_ru, alias_url, sort', 'safe', 'on' => 'search'),
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
            'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
            'articlesPictures' => array(self::HAS_MANY, 'ArticlesPictures', 'article_id'),
            'onePicture'=>array(self::HAS_ONE, 'ArticlesPictures', 'article_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'category_id' => 'Category',
            'name_uk' => 'Name Uk',
            'name_ru' => 'Name Ru',
            'name_en' => 'Name En',
            'description_uk' => 'Description Uk',
            'description_en' => 'Description En',
            'description_ru' => 'Description Ru',
            'alias_url' => 'Alias Url',
            'sort' => 'Sort',
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
        
        $criteria->compare('name_uk', $this->name_uk, true);
        $criteria->compare('name_ru', $this->name_ru, true);
        $criteria->compare('name_en', $this->name_en, true);
        $criteria->compare('description_uk', $this->description_uk, true);
        $criteria->compare('description_en', $this->description_en, true);
        $criteria->compare('description_ru', $this->description_ru, true);
        $criteria->compare('alias_url', $this->alias_url, true);
        $criteria->compare('sort', $this->sort);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>false,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Articles the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * scope
     */
    public function category($alias_url = false)
    {
        if ($alias_url)
        {
            $this->getDbCriteria()->mergeWith(array(
                'condition' => 'category_id = ' ."'".Categories::getIdByAlias($alias_url)."'"
            ));
        }
        return $this;
    }
    
    public function getUrl()
    {
        return Yii::app()->createUrl($this->modelClass) .'/'.$this->category->alias_url.'/'. $this->alias_url;
    }
    

    public function getName()
    {
        $attribute = 'name_' . Yii::app()->language;
        return $this->{$attribute};
    }

    public function setName($value)
    {
        $attribute = 'name_' . Yii::app()->language;
        $this->{$attribute} = $value;
    }
    
    public function getDescription()
    {
        $attribute = 'description_' . Yii::app()->language;
        return $this->{$attribute};
    }

    public function setDescription($value)
    {
        $attribute = 'description_' . Yii::app()->language;
        $this->{$attribute} = $value;
    }

}
