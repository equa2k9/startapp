<?php

class CatalogController extends FrontendSiteController
{
    public $headerTitle = '';
    public $layout = '//layouts/column2';

    public function actionIndex($alias_url = false)
    {
        if ($alias_url == 'index')
        {
            $alias_url = false;
        }
        
        $dataProvider = Articles::model()->category($alias_url)->search();
        $this->headerTitle = ($alias_url!=false)?Categories::getNameByAlias($alias_url):Yii::t('site','All products');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($alias_url,$alias)
    {
        $this->layout = '//layouts/column1';
        $this->render('view', array(
            'model' => $this->loadModelByAlias(strtolower($alias)),
        ));
    }

    public function loadModelByAlias($alias_url)
    {
        $model = Articles::model()->findByAttributes(array('alias_url' => $alias_url));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
