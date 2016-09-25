<?php
namespace ApiArchitect\Abstracts;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use ApiArchitect\Contracts\RepositoryContract;
/**
 * Class RepositoryAbstract
 *
 * @package ApiArchitect\Abstracts
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class RepositoryAbstract extends EntityRepository implements RepositoryContract
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
     * @param array $data
     * @return mixed
     */
    abstract public function create(array $data);
    /**
     * @param int $id
     * @return bool|OptimisticLockException|ORMInvalidArgumentException|\Exception
     */
    public function destroy($id)
    {
        try {
            $entity = $this->find($id);
            $this->_em->remove($entity);
            $this->_em->flush();
        } catch (OptimisticLockException $e) {
            return $e;
        } catch (ORMInvalidArgumentException $e) {
            return $e;
        }
        return true;
    }
    /**
     * @param int $id
     * @param array $updatedEntity
     * @return mixed
     */
    abstract public function update($id, array $updatedEntity);
}