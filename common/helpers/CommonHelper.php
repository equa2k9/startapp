<?php

class CommonHelper
{

    /**
     *
     * array of colors to stroke different trips
     * @var array
     */
    public static $colors = array(
        '#c23b22',
        '#966fd6',
        '#013220',
        '#8b008b',
        '#dc143c',
        '#00ffff',
        '#0047ab',
        '#bd33a4',
        '#0070ff',
        '#ff2052',
        '#008000',
        '#ff033e',
        '#5d8aa8',
        '#e32636',
        '#00ffff',
        '#50c878',
        '#ff00ff',
        '#00ff7f',
        '#138808',
        '#d73b3e',
        '#967bb6',
        '#f984ef',
        '#534b4f',
        '#674c47'
    );

    /**
     * function to check if one row has all empty attribute
     * if one of the attributes has value return true and false if none of
     * attributes has no value
     */
    public static function checkAllEmptyAttributes(&$model)
    {
        foreach($model as $key=>$attribute)
        {
            if($attribute !== null && $attribute !=='')
            {
                return true;
            }
        }
        return false;
    }

}
