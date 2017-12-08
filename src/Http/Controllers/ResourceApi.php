<?php
	declare(strict_types=1);

	namespace ApiArchitect\Compass\Http\Controllers {

		use ApiArchitect\{
			Auth\Entities\User
		};

		use Codeception\Exception\TestRuntimeException;
		use Jkirkby91\{
			LumenRestServerComponent\Http\Controllers\ResourceController,
			Boilers\RestServerBoiler\TransformerContract as ObjectTransformer,
			Boilers\RepositoryBoiler\ResourceRepositoryContract as ResourceRepository
		};

		/**
		 * Class ResourceApi
		 *
		 * @package ApiArchitect\Compass\Http\Controllers
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		abstract class ResourceApi extends ResourceController
		{

			/**
			 * @var User $user
			 */
			protected $user;

			/**
			 * ResourceApi constructor.
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
			 * @param int $uid
			 *
			 * @return bool
			 */
			public function validateRequestedUserContentPath(int $uid) : bool
			{
				if ($uid !== $this->user->getId())
				{
					throw new UnauthorizedHttpException;
				}

				return TRUE;
			}

			/**
			 * getUser()
			 * @return \ApiArchitect\Auth\Entities\User
			 */
			public function getUser() : User
			{
				return $this->user;
			}

			/**
			 * setUser()
			 * @param \ApiArchitect\Auth\Entities\User $user
			 *
			 * @return \ApiArchitect\Compass\Http\Controllers\ResourceApi
			 */
			public function setUser(User $user) : ResourceApi
			{
				$this->user = $user;
				return $this;
			}

		}
	}
	