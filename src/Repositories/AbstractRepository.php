<?php
	declare(strict_types=1);

	namespace ApiArchitect\Compass\Repositories;

	use Doctrine\{
		ORM\ORMException
	};

	use Illuminate\{
		Support\Collection,
		Pagination\LengthAwarePaginator
	};

	use LaravelDoctrine\{
		ORM\Pagination\Paginatable
	};

	use Jkirkby91\{
		LumenDoctrineComponent\Repositories\LumenDoctrineEntityRepository
	};

	/**
	 * Class AbstractRepository
	 *
	 * @package ApiArchitect\Compass\Repositories
	 * @author  James Kirkby <jkirkby@protonmail.ch>
	 */
	abstract class AbstractRepository extends LumenDoctrineEntityRepository
	{
		use Paginatable;

		/**
		 * @return array
		 */
		public function all()
		{
			return $this->findAll();
		}

		/**
		 * @param $paginate
		 * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
		 */
		public function paginated($paginate)
		{
			return $this->paginated($paginate);
		}

		/**
		 * @param array $needle
		 * @param int $paginate
		 * @return array
		 */
		public function search(array $needle, $paginate = 0)
		{
			return $this->findBy($needle,null,25,$paginate);
		}

		/**
		 * lumenPaginatedQuery()
		 * @param     $results
		 * @param int $page
		 *
		 * @return \Illuminate\Pagination\LengthAwarePaginator
		 * @throws \Exception
		 */
		public function lumenPaginatedQuery($results,int $page = 1) : LengthAwarePaginator
		{
			$pageLimit = config('lumendoctrine.paging.default_limit');

			try {
				$resource = new Collection($results);
				return new LengthAwarePaginator($resource->forPage($page,$pageLimit),$resource->count(),$pageLimit,$page);
			} catch (ORMException $e){
				$this->resetClosedEntityManager();
			}
		}
	}
