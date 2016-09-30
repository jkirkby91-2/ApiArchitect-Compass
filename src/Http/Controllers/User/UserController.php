<?php

namespace ApiArchitect\Compass\Http\Controllers\User;

use ApiArchitect\Compass\Entities\User;
use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\LumenRestServerComponent\Http\Controllers\ResourceController;
use Jkirkby91\Boilers\RestServerBoiler\Exceptions;

/**
 * Class USerController
 *
 * @package app\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
final class UserController extends ResourceController
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

        $userRegDetails = $request->getParsedBody();

        if($userRegDetails['password'] !== $userRegDetails['password_confirmation'])
        {
            throw new Exceptions\UnprocessableEntityException;
        }

        $userEntity = new User(
            $userRegDetails['password'],
            $userRegDetails['email'],
            json_encode([
                'firstname' =>  $userRegDetails['firstname'],
                'lastname'  =>  $userRegDetails['lastname']
            ]),
            $userRegDetails['username']
        );

        $user = $this->repository->store($userEntity);
        $token = app()->make('auth')->fromUser($user);

        $resource = fractal()
            ->item($user)
            ->transformWith(new \ApiArchitect\Compass\Http\Transformers\UserTransformer())
            ->addMeta(['token' => $token])
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray();

        return $this->createdResponse($resource);
    }
}