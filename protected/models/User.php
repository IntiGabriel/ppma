<?php

/**
 * @property string  $encryptionKey
 * @property integer $id
 * @property boolean $isAdmin
 * @property string  $password
 * @property string  $salt
 * @property string  $username
 */
class User extends CActiveRecord
{

    /**
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'encryptionKey' => 'Encryption Key',
            'id'            => 'ID',
            'isAdmin'       => 'Is User Admin?',
            'password'      => 'Password',
            'salt'          => 'Salt',
            'username'      => 'Username',
        );
    }

    /**
     * @param CEvent $event
     */
    public function generateEncryptionKey(CEvent $event)
    {
        if (strlen($this->password) > 0)
        {
            $key = md5(rand());
            $this->encryptionKey = Yii::app()->securityManager->encrypt($key, $this->password);
        }
    }

    /**
     * @param CEvent $event
     */
    public function padPassword(CEvent $event)
    {
        if (strlen($this->password) > 0)
        {
            $this->password = Yii::app()->securityManager->padUserPassword($this->password, $this);
        }
    }

    /**
     * @return array
     */
    public function relations()
    {
        return array(
            'entries' => array(self::HAS_MANY, 'Entry', 'userId')
        );
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('encryptionKey', 'required'),
            array('encryptionKey', 'unsafe'),

            array('isAdmin', 'default', 'value' => false),
            array('isAdmin', 'boolean'),
            array('isAdmin', 'unsafe'),

            array('password', 'required'),
            array('password', 'length', 'max' => 40, 'skipOnError' => true),

            array('salt', 'required'),
            array('salt', 'length', 'max' => 32, 'skipOnError' => true),

            array('username', 'required'),
            array('username', 'length', 'max' => 255, 'skipOnError' => true),
            array('username', 'unique', 'className' => 'User', 'attributeName' => 'username', 'skipOnError' => true),
        );
    }

    /**
     * @param CEvent $event
     */
    public function saltPassword(CEvent $event)
    {
        if (strlen($this->password) > 0)
        {
            $this->password = sha1($this->salt . $this->password);
        }
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return void
     */
    protected function afterConstruct()
    {
        $this->salt = md5(rand());
        parent::afterConstruct();
    }

}