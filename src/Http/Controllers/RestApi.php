<?php

namespace ApiArchitect\Compass\Http\Controllers;

use Tymon\JWTAuth\JWTAuth;
use Jkirkby91\LumenRestServerComponent\Http\Controllers\ResourceController;
use Jkirkby91\Boilers\RestServerBoiler\TransformerContract as ObjectTransformer;
use Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract as ResourceRepository;

/**
 * Class RestApi
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 */
abstract class RestApi extends ResourceController
{

    public function __construct(ResourceRepository $repository, ObjectTransformer $objectTransformer)
    {
        parent::__construct($repository,$objectTransformer);
    }
}