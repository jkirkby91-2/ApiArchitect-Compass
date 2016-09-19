<?php

namespace ApiArchitect\Compass\Http\Controllers\User;

use ApiArchitect\Compass\Contracts\RequestContract;
use ApiArchitect\Compass\Http\Requests\UserRequest;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use League\Fractal;
use ApiArchitect\Compass\Contracts\TransformerContract;
use ApiArchitect\Compass\Http\Controllers\RestController;
use ApiArchitect\Compass\Http\Transformers\UserTransformer;
use ApiArchitect\Compass\Contracts\RepositoryContract AS EntityRepository;

/**
 * Class USerController
 *
 * @package app\Http\Controllers
 * @author James Kirkby <me@jameskirkby.com>
 */
final class UserController extends RestController
{

    use Helpers;

    /**
     * @var
     */
    protected $repository;

    /**
     * @var
     */
    protected $transformer;

    /**
     * @var Fractal\Manager
     */
    protected $fractal;

    /**
     * UserController constructor.
     *
     * @param EntityRepository $userRepository
     * @param UserTransformer $userTransformer
     */
    public function __construct(EntityRepository $userRepository)
    {
        $this->repository = $userRepository;
        $this->transformer = new UserTransformer();
        $this->fractal = new Fractal\Manager();
    }

    /**
     * @param Request $userRequest
     * @return \Dingo\Api\Http\Response
     */
    public function register(Request $userRequest)
    {
        return $this->store($userRequest);
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        //@TODO add permission check so only admin can directly access this function
        if(!is_null($request->input('include')))
        {
            $this->fractal->parseIncludes($request->input('include'));
        }

        $user = $this->repository->create([
            'username'  => $request->get('username'),
            'email'     => $request->get('email'),
            'password'  => $request->get('password'),
        ]);

        $token = app()->make('auth')->fromUser($user);

//        $illuminateCollection = collect($user);

        $resource = new Fractal\Resource\Item($user,New UserTransformer);

        $dingoResponse = response(json_encode($resource->getData()));
        return $dingoResponse;
    }
}