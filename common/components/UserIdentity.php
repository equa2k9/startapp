<?php

class UserIdentity extends CUserIdentity
{

    protected $_id;

    public function authenticate()
    {
        $user = Users::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if (($user === null) || (crypt($this->password, $user->password_hash) !== $user->password))
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if($user->is_activated == Users::IS_NOTACTIVATED)
        {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        }
        else
        {
            $this->_id = $user->id;

            $this->username = $user->username;

            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

}
