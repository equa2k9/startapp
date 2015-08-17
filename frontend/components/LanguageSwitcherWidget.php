<?php

class LanguageSwitcherWidget extends CWidget
{
    public $languagesSelect = array(
        'Українська'=>'ua',
        'Русский'=>'ru',
        'English'=>'gb'
    );
     public $languagesName = array(
        'ua'=>'Українська',
        'ru'=>'Русский',
        'en'=>'English'
    );
    public function run()
    {
        
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $links = array();
        foreach (DMultilangHelper::suffixList() as $suffix => $name)
        {
            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;
            $links[] = '<li><a href="' . $url . '"><i class="flag-icon flag-icon-'.$this->languagesSelect[$name].'"></i>'.$name.'</a></li>';
        }
        $this->render('languageSwitcher',array('links'=>$links));
    }

}
