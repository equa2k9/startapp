<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $name_en
 * @property string $alias
 * @property string $picture
 *
 * The followings are the available model relations:
 * @property Articles[] $articles
 */
class Categories extends CommonActiveRecord
{

    public $modelClass = 'catalog';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'categories';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name_uk, name_ru, name_en, alias, picture', 'required'),
            array('name_uk, name_ru, name_en, alias', 'length', 'max' => 50),
            array('picture', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name,name_uk, name_ru, name_en, alias, picture', 'safe', 'on' => 'search'),
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
            'articles' => array(self::HAS_MANY, 'Articles', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name_uk' => 'Name Uk',
            'name_ru' => 'Name Ru',
            'name_en' => 'Name En',
            'alias' => 'Alias',
            'picture' => 'Picture',
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
        $criteria->compare('name_'.Yii::app()->language, $this->name, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('picture', $this->picture, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Categories the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * language set/get attributes
     * @return type
     */
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
    
    /**
     * get menu items to sidebar
     * @return array
     */
    public static function getCategoriesMenu($look=false)
    {
        $model = self::model()->findAll();
        $menu = array();
        foreach($model as $item)
        {
           $menu[] = array('label'=>$item->name,'url'=>$item->getUrl());
        }
        return $menu;
    }
    
    public static function getIdByAlias($alias_url)
    {
        
        
        if($model = self::model()->findByAttributes(array('alias_url'=>$alias_url)))
        {
           
            return $model->id;
        }
        else
        {
            return false;
        }
    }
    public static function getNameByAlias($alias_url)
    {
        
        if($model = self::model()->findByAttributes(array('alias_url'=>$alias_url)))
        {
           
            return $model->name;
        }
        else
        {
            return Yii::t('zii','No results found.');
        }
    }

}
