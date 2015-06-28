<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 */
class DMultilangHelper
{
    public static function enabled()
    {
        return count(Yii::app()->params['translatedLanguages']) > 1;
    }
 
    public static function suffixList()
    {
        $list = array();
        $enabled = self::enabled();
 
        foreach (Yii::app()->params['translatedLanguages'] as $lang => $name)
        {
            if ($lang === Yii::app()->params['defaultLanguage']) {
                $suffix = '';
                $list[$suffix] = $enabled ? $name : '';
            } else {
                $suffix = '_' . $lang;
                $list[$suffix] = $name;
            }
        }
 
        return $list;
    }
 
     public static function processLangInUrl($url)
    {		
        if (self::enabled())
        {
            $domains = explode('/', ltrim($url, '/'));
			
			$lang = Yii::app()->params['defaultLanguage'];
			for ($i=0; $i<count($domains); $i++) {
				if ( in_array($domains[$i], array_keys(Yii::app()->params['translatedLanguages'])) ) {
					$lang = $domains[$i];
				}
			}			
			Yii::app()->setLanguage($lang);
			$url = str_replace($lang.'/', '', $url);	
        }
 
        return $url;
    }
 
    public static function addLangToUrl($url)
    {
        if (self::enabled())
        {
            $domains = explode('/', ltrim($url, '/'));
            $isHasLang = in_array($domains[0], array_keys(Yii::app()->params['translatedLanguages']));
            $isDefaultLang = Yii::app()->getLanguage() == Yii::app()->params['defaultLanguage'];
 
            if ($isHasLang && $isDefaultLang)
                array_shift($domains);
// if ($isHasLang && $isDefaultLang)
//                array_shift($domains);
            if (!$isHasLang && !$isDefaultLang)
                array_unshift($domains, Yii::app()->getLanguage());
 
            $url = '/' . implode('/', $domains);
        }
 
        return $url;
    }
}