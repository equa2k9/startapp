<?php

/**
 * Base class for our web application.
 *
 * Here will be the tweaks affecting the behavior of all entry points.
 *
 * @package YiiBoilerplate
 */
class WebApplication extends CWebApplication
{

    /**
     * Workaround to fallback to `en` locale even if something unknown to us was requested.
     *
     * @param string $localeID
     * @return CLocale
     */
    public function getLocale($localeID = null)
    {
        try
        {
            return parent::getLocale($localeID);
        }
        catch (Exception $e)
        {
            return CLocale::getInstance('en');
        }
    }

    /**
     * 
     * @param string $layout
     * @param object model $model
     * @param string $description
     * @return boolean
     */
    public function sendConfirmMail($layout = 'default', $model = NULL, $description = NULL)
    {
        $mail = new YiiMailer($layout, array('model' => $model, 'description' => $description));

        $mail->setFrom($model->email, isset($model->username) ? $model->username : '');
        $mail->setSubject($description);
        $mail->setTo(array($model->email));
        if ($mail->send())
            return true;
        else
            return false;
    }

}
