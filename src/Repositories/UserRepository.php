<?php

namespace ApiArchitect\Compass\Repositories;

use Jkirkby91\Boilers\NodeEntityBoiler\EntityContract AS Entity;

/**
 * Class UserRepository
 *
 * @package app\Repositories\Dog
 * @author James Kirkby <jkirkby91@gmail.com>
 */
class UserRepository extends \Jkirkby91\DoctrineRepositories\DoctrineRepository implements \Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract
{
    use \Jkirkby91\DoctrineRepositories\ResourceRepositoryTrait;

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->listResponse($this->repository->all());
    }

    /**
     * @param Entity $entity
     * @return Entity
     */
    public function store(Entity $entity)
    {
        //@TODO some erro checking/ exception throwing
        $unHashedPass = $entity->getPassword();
        $entity->setPassword(app()->make('hash')->make($unHashedPass));
        $this->_em->persist($entity);
        $this->_em->flush();
        //@TODO try catch check if email is unique value then return a formatted response at moment returns geenri sql error
        return $entity;
    }

    /**
     * @param Entity $entity
     * @return Entity|null|object
     */
    public function update(Entity $entity)
    {
        $data = $request->getParsedBody();
        $entity = $this->find($id);
        if(key_exists('username',$data)){
            $entity->setName($data['username']);
        }
        if(key_exists('email',$data)){
            $entity->setEmail($data['email']);
        }
        $this->_em->persist($entity);
        $this->_em->flush();
        return $entity;
    }
}