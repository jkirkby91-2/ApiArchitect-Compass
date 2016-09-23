<?php

namespace ApiArchitect\Compass\Http\Controllers\User;

use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\LumenRestServerComponent\Http\Controllers\ResourceController;

/**
 * Class USerController
 *
 * @package app\Http\Controllers
 * @author James Kirkby <me@jameskirkby.com>
 */
final class UserController extends ResourceController implements \Jkirkby91\Boilers\RestServerBoiler\ResourceControllerContract
{

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function register(ServerRequestInterface $request)
    {
        //implement password confirm check
        return $this->store($request);
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function store(ServerRequestInterface $request)
    {

        //@TODO Do some pre Routed Validation
        //@TODO Check CRUD permission
        //@TODO wrap in try catch
        $user = $this->repository->store($request);
        $token = app()->make('auth')->fromUser($user);

        $resource = fractal()
            ->item($user)
            ->transformWith(new \ApiArchitect\Compass\Http\Transformers\UserTransformer())
            ->addMeta(['token' => $token])
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray();
//        dd($resource);

        return $this->createdResponse($resource);
    }
}