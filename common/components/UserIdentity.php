<?php

class UserIdentity extends CUserIdentity
{

    protected $_id;
    
    /*
     * Not confirmed e-mail
     */
    const ERROR_NOT_CONFIRMED = 8;
    
    /*
     * not activated by administrator
     */
//    const ERROR_NOT_ACTIVATED = 9;

    public function authenticate()
    {
        $user = Users::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if (($user === null) || (crypt($this->password, $user->password_hash) !== $user->password))
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if($user->hash_link !==NULL)
        {
            $this->errorCode = self::ERROR_NOT_CONFIRMED;
        }
//        else if($user->is_activated == Users::IS_NOT_ACTIVATED)
//        {
//            $this->errorCode = self::ERROR_NOT_ACTIVATED;
//        }
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
