<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontendSiteController extends CommonController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $bodyId = 'home';

    public function init()
    {
        $this->getMenu(); //in init this sets menu list
        parent::init();
    }

    /**
     * overdrived function to set menu
     */
    public function getMenu()
    {
        return $this->menu = array(
            array('label' => 'Home', 'url' => array('/site/index'),'htmlOptions'=>array('class'=>'list-group-item')),
            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
            array('label' => 'Contact', 'url' => array('/site/contact'))
        );
    }

}
