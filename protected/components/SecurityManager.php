<?php

class SecurityManager extends CSecurityManager
{

    /**
     * @param $password
     * @param User|null $user
     * @return string
     * @throws CException
     */
    public function padUserPassword($password, $user = null)
    {
        if (!($user instanceof User))
        {
            $user = User::model()->findByPk(Yii::app()->user->id);
        }

        if (!is_object($user))
        {
            throw new CException();
        }

        return substr($password . $user->salt, 0, 32);
    }

}