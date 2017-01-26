<?php

namespace ApiArchitect\Compass\Http\Controllers\User;

use Tymon\JWTAuth\JWTAuth;
use ApiArchitect\Compass\Entities\User;
use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\Boilers\RestServerBoiler\Exceptions;
use Spatie\Fractal\ArraySerializer AS ArraySerialization;
use Jkirkby91\LumenRestServerComponent\Http\Controllers\ResourceController;

/**
 * Class USerController
 *
 * @package app\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
final class UserController extends ResourceController {


    /**
     * @var $auth
     */
    protected $auth;


    /**
     * AuthenticateController constructor.
     * @param JWTAuth $auth
     */
    public function __construct(JWTAuth $)
    {
    			dd($auth);

        $this->auth = $auth;


    }

	public function index(ServerRequestInterface $request) {
		$user = $this->auth->toUser();

		// dd($user);

		$resource = fractal()
			->item($user)
			->transformWith(new \ApiArchitect\Compass\Http\Transformers\UserTransformer())
			->serializeWith(new ArraySerialization())
			->toArray();

		return $this->showResponse($resource);
	}

	/**
	 * @param ServerRequestInterface $request
	 * @return mixed
	 */
	public function register(ServerRequestInterface $request) {
		return $this->store($request);
	}

	/**
	 * @param ServerRequestInterface $request
	 * @return mixed
	 */
	public function store(ServerRequestInterface $request) {

		//@TODO Do some pre Routed Validation
		//@TODO Check CRUD permission
		//@TODO wrap in try catch

		$userRegDetails = $request->getParsedBody();

		//@TODO move this into a validation middleware
		if ($userRegDetails['password'] !== $userRegDetails['password_confirmation']) {
			throw new Exceptions\UnprocessableEntityException;
		}

		//@TODO move into validation middlware
		if (!array_key_exists('role', $userRegDetails)) {
			throw new Exceptions\UnprocessableEntityException('No user role for registration specified');
		} else {
			if (in_array($userRegDetails['role'], array('admin','administrator','superadministrator'))){
				throw new Exceptions\UnprocessableEntityException('Un-authorised role type');
			}
		}

		$userEntity = new User(
			$userRegDetails['password'],
			$userRegDetails['email'],
			json_encode([
					'firstname' => $userRegDetails['firstname'],
					'lastname'  => $userRegDetails['lastname']
				]),
			$userRegDetails['username']
		);

		$targetRole = app()
			->make('em')
			->getRepository('\ApiArchitect\Auth\Entities\Role')
			->findOneBy(['name' => $userRegDetails['role']]);

		if (is_null($targetRole)) {
			throw new Exceptions\UnprocessableEntityException('target role not found');
		} else {
			$userEntity->addRoles($targetRole);
		}

		$user  = $this->repository->store($userEntity);
		$token = app()->make('auth')->fromUser($user);

		$resource = fractal()
			->item($user)
			->transformWith(new \ApiArchitect\Compass\Http\Transformers\UserTransformer())
			->addMeta(['token' => $token])
			->addMeta(['role' => $targetRole->getName()])
			->serializeWith(new ArraySerialization())
			->toArray();

		return $this->createdResponse($resource);
	}

	/**
	 * @param ServerRequestInterface $request
	 * @param $id
	 * @return mixed
	 */
	public function update(ServerRequestInterface $request, $id) 
	{
		$userProfileDetails = $request->getParsedBody();

		try {
			if (!$data = $this->repository->show($id)) {
				throw new Exceptions\NotFoundHttpException();
			}
		} catch (Exceptions\NotFoundHttpException $exception) {
			$this->notFoundResponse();
		}

		if (isset($userProfileDetails['roles'])) {
			$data = $data->setRoles($userProfileDetails['roles']);
		}

		if (isset($userProfileDetails['username'])) {
			$data = $data->setUserName($userProfileDetails['username']);
		}

		if (isset($userProfileDetails['username'])) {
			$data = $data->setEmail($userProfileDetails['email']);
		}

		//@TODO Create a new route for password resets that does some validation middleware
		if (isset($userProfileDetails['password'])) {

			try {
				if ($userProfileDetails['password'] !== $userProfileDetails['password_confirmation']) {
					throw new Exceptions\UnprocessableEntityException('Passwords do not match');
				}
			} catch (Exceptions\UnprocessableEntityException $exception) {
				$this->clientErrorResponse($exception->getMessage());
			}

			$data = $data->setPassword($userProfileDetails['password']);
		}

		if (isset($userProfileDetails['permissions'])) {
			$data = $data->setPermissions($userProfileDetails['permissions']);
		}

		$this->repository->update($data);

		return $this->createdResponse(Fractal()
			->item($data)
				->transformWith($this->transformer)
				->serializeWith(new ArraySerialization())
			->toJson());
	}

	/**
	 * @TODO check email is unique
	 */
	public function checkUniqueEmail(ServerRequestInterface $request)
	{
		$emailTarget = $request->getParsedBody();

		if (!in_array('email', $emailTarget))
		{
			throw new Exceptions\UnprocessableEntityException('no email defined');
		}

		$email = app()
			->make('em')
			->getRepository('\ApiArchitect\Compass\Entities\User')
			->findOneBy(['email' => $emailTarget['email']]);

		if (is_null($email)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @TODO chcek username is unique
	 */
	public function checkUniqueUserName(ServerRequestInterface $request) 
	{
		$userNameTarget = $request->getParsedBody();

		if (!in_array('username', $userNameTarget))
		{
			throw new Exceptions\UnprocessableEntityException('no username defined');
		}

		$username = app()
			->make('em')
			->getRepository('\ApiArchitect\Compass\Entities\User')
			->findOneBy(['username' => $userNameTarget['username']]);

		if (is_null($username)) {
			return true;
		} else {
			return false;
		}
	}
}