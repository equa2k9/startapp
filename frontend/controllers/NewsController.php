<?php

class NewsController extends FrontendSiteController
{

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('News');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($alias_url)
    {
        
        $this->render('view', array(
            'model' => $this->loadModelByAlias($alias_url),
        ));
    }

    public function loadModel($id)
    {
        $model = News::model()->findByPk($id);
        if ($model === null)
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    public function loadModelByAlias($alias_url)
    {
        $model = News::model()->findByAttributes(array('alias_url' => $alias_url));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
