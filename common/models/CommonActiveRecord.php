<?php
class CommonActiveRecord extends CActiveRecord
{
    public $modelClass='';
    
    public function getUrl()
    {
        return Yii::app()->createUrl($this->modelClass) .'/'. $this->alias_url;
    }
    public function getUrlByItem($alias)
    {
        return Yii::app()->createUrl($this->modelClass). '/'.$alias;
    }
    public function getId()
    {
        return $this->id;
    }
}