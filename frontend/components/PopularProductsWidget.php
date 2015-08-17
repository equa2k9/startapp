<?php

class PopularProductsWidget extends CWidget
{

    public function run()
    {

        $model = Articles::model()->findAll(array('limit'=>4));
        $this->render('popularProducts', array('model' => $model));
    }

}
