<?php

namespace ApiArchitect\Compass\Repositories;

use Doctrine\ORM\ORMException;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Jkirkby91\LumenDoctrineComponent\Repositories\LumenDoctrineEntityRepository;

/**
 * Class RepositoryAbstract
 *
 * @package ApiArchitect\Abstracts
 * @author James Kirkby <hello@jameskirkby.com>
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
    public function search(array $needle,$paginate = 0)
    {
        return $this->findBy($needle,null,25,$paginate);
    }

    /**
     * @param array $criteria
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function lumenPaginatedQuery($results,$page = 1)
    {
        $pageLimit = config('lumendoctrine.paging.default_limit');

        try {
            $resource = new Collection($results);
            return new LengthAwarePaginator($resource->forPage($page,$pageLimit),$resource->count(),$pageLimit,$page);
        } catch (ORMException $e){
            $this->resetClosedEntityManager();
            throw new \Exception($e);
        }
    }    

}
