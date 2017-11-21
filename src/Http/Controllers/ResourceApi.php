<?php

	namespace ApiArchitect\Compass\Http\Controllers;

	use ApiArchitect\Auth\Entities\User;
		use Tymon\JWTAuth\JWTAuth;
	use Jkirkby91\LumenRestServerComponent\Http\Controllers\ResourceController;
	use Jkirkby91\Boilers\RestServerBoiler\TransformerContract as ObjectTransformer;
	use Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract as ResourceRepository;

	/**
	 * Class ResourceApi
	 *
	 * @package ApiArchitect\Compass\Http\Controllers
	 * @author  James Kirkby <jkirkby@protonmail.ch>
	 */
	abstract class ResourceApi extends ResourceController
	{
		
		protected $user;

		/**
		 * RestApi constructor.
		 *
		 * @param \Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract $repository
		 * @param \Jkirkby91\Boilers\RestServerBoiler\TransformerContract        $objectTransformer
		 */
		public function __construct(ResourceRepository $repository, ObjectTransformer $objectTransformer)
		{
			parent::__construct($repository,$objectTransformer);
			$this->setUser(app()->make('\ApiArchitect\Auth\ApiArchitectAuth')->getUser());
		}

		/**
		 * validateRequestedUserContentPath()
		 * @param $uid
		 */
		public function validateRequestedUserContentPath(int $uid)
		{
			if ($uid !== $this->user->getId())
			{
				throw new UnauthorizedHttpException;
			}
		}

		/**
		 * getRequestUser()
		 * @return mixed
		 */
		public function getUser()
		{
			return $this->user;
		}

		/**
		 * setUser()
		 * @param $user
		 *
		 * @return $this
		 */
		public function setUser(User $user)
		{
			$this->user = $user;
			return $this;
		}
	
	}
	