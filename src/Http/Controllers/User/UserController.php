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

    public function index(ServerRequestInterface $request)
    {
        $user = $this->auth->toUser();

        $resource = fractal()
            ->item($user)
            ->transformWith(new \ApiArchitect\Compass\Http\Transformers\UserTransformer())
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray();

        return $this->showResponse($resource);
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function register(ServerRequestInterface $request)
    {
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

        //@TODO move this into a validation middleware
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

    /**
     * @param ServerRequestInterface $request
     * @param $id
     * @return mixed
     */
    public function update(ServerRequestInterface $request,$id)
    {
        try {
            if(!$data = $this->repository->show($id))
            {
                throw new Exceptions\NotFoundHttpException();
            }
        } catch (Exceptions\NotFoundHttpException $exception) {
            $this->notFoundResponse();
        }

        $roles = $data->getRoles();
        if(!is_null($roles)){
            $data = $data->setRoles($data['roles']);
        }

        $username = $data->getUsername()
        if(!is_null($username)){
            $data = $data->setUserName($data['username']);
        }

        $email = $data->getEmail();
        if(!is_null($email)){
            $data = $data->setEmail($data['email']);
        }

        //@TODO Create a new route for password resets that does some validation middleware
        if(isset($data['password'])){

            try {
                if($data['password'] !== $data['password_confirmation'])
                {
                    throw new Exceptions\UnprocessableEntityException('Passwords do not match');
                }
            } catch (Exceptions\UnprocessableEntityException $exception){
                $this->clientErrorResponse($exception->getMessage());
            }

            $data = $data->setPassword($data['password']);
        }

        if(isset($data['permissions'])){
            $data = $data->setPermissions($data['permissions']);
        }

        $this->repository->update($data);

        return $this->createdResponse(Fractal()
            ->item($data)
            ->transformWith($this->transformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toJson());
    }
}