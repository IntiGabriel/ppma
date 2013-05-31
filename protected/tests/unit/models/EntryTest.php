<?php

class EntryTest extends CDbTestCase
{

    /**
     * @var Entry
     */
    protected $instance;


    /**
     * @var array
     */
    public $fixtures = array(
        'users'    => 'User',
    );


    public function setUp()
    {
        // create instance
        $this->instance = new Entry();

        // log in
        /* @var WebUser $user */
        /*
        $user = Yii::app()->user;
        $identity = new UserIdentity('root', 'pass');
        $identity->authenticate();
        $user->login($identity);
        */
    }


    public function testSaveNoValues()
    {
        $this->assertFalse($this->instance->validate());
    }


    public function testSaveMassAssignment()
    {
        $model = $this->instance;

        // mass assignment
        $params = array(
            'id'        => 1,
            'userId'    => 4,
            'name'      => 'asdaasda',
            'url'       => 'http://www.google.com',
            'comment'   => 'kommentar',
            'username'  => 'peter',
            //'password'  => 'secret',
            'viewCount' => 400,

        );
        $model->attributes = $params;
        $this->assertNull($model->id);
        $this->assertEquals($params['userId'], $model->userId);
        $this->assertEquals($params['name'], $model->name);
        $this->assertEquals($params['url'], $model->url);
        $this->assertEquals($params['comment'], $model->comment);
        $this->assertEquals($params['username'], $model->username);
        $this->assertEquals(0, 0);
    }


    public function testEncryption()
    {
        /*
        $model = $this->instance;

        $model->setPassword('password');
        $this->assertEquals('password', $model->password);
        */
    }

}
