<?php

namespace ApiArchitect\Compass\Http\Controllers;

use Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract as ResourceRepository;
use Jkirkby91\Boilers\RestServerBoiler\TransformerContract as ObjectTransformer;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class RestApi
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 */
abstract class RestApi extends \Jkirkby91\LumenRestServerComponent\Http\Controllers\ResourceController
{

    protected $user;

    public function __construct()
    {
        $this->user = app()->make('auth')->getUser();
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}