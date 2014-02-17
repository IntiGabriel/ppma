<?php

namespace ppma;

use Hahns\Hahns;
use Hahns\Request;
use Hahns\Response\Json;
use Hahns\Response;
use ppma\Exception\Response\ForbiddenException;
use ppma\Factory\ActionFactory;
use ppma\Logger;

class Manager
{

    /**
     * @var Hahns
     */
    protected $app;

    /**
     * @param array $config
     * @throws \InvalidArgumentException
     */
    public function __construct($config = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        // create instance of Hahns
        $this->app = new Hahns($config);

        // create and init logger
        Logger::init($this->app->config('log'));

        // register routes
        $this->registerServices();
        $this->registerRoutes();
    }

    /**
     * @return void
     */
    protected function registerServices()
    {
        $prepare = function ($id) {
            /* @var Service $service */
            $service = new $id();
            $service->setApplication($this->app);
            $service->init();
            return $service;
        };

        $this->app->service('db', function () use ($prepare) {
            return $prepare('\ppma\Service\Database');
        });

        $this->app->service('user', function () use ($prepare) {
            return $prepare('\ppma\Service\Model\User');
        });

        $this->app->service('password', function () use ($prepare) {
            return $prepare('\ppma\Service\Password');
        });
    }

    /**
     * @return void
     */
    protected function registerRoutes()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $caller = function ($id, $args = []) {
            /* @var \ppma\Action $action */
            $action = ActionFactory::create($id, $args);

            // set application to action
            $action->setApplication($this->app);

            // trigger `before`-event
            $action->before();

            // run action
            $response = $action->run();

            // triger `after`-event
            $action->after();

            // return response
            return $response;
        };

        // server
        $this->app->get('/', function (Json $res) use ($caller) {
            return $caller('\ppma\Action\Server\RedirectToPingAction', [$res]);
        });

        $this->app->get('/ping', function (Json $res) use ($caller) {
            return $caller('\ppma\Action\Server\PingAction', [$res]);
        });

        // auth
        $this->app->post('/users/[.+:slug]/auth', function (Request $req, Json $res) use ($caller) {
            return $caller('\ppma\Action\Auth\CreateNewKeyAction', [$req, $res]);
        });

        $this->app->get('/users/[.+:slug]/auth/[.+:password]', function (Request $req, Json $res) use ($caller) {
            return $caller('\ppma\Action\Auth\AuthAction', [$req, $res]);
        });

        // user
        $this->app->post('/users', function (Request $req, Json $res) use ($caller) {
            return $caller('\ppma\Action\User\CreateAction', [$req, $res]);
        });
    }

    /**
     * @return void
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        try {
            $this->app->run();
        } catch (ForbiddenException $e) {
            /* @var Json $response */
            $response = $this->app->service('json-response');
            echo $response->send([
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ], Response::CODE_FORBIDDEN);
        }

    }
}
