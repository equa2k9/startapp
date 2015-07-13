<?php

class CategoriesLandingWidget extends CWidget
{

    public function run()
    {

        $model = Categories::model()->findAll();
        
        $this->render('categoriesLanding', array('model' => $model));
    }

}
