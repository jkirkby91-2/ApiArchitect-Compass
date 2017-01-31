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
        $entity = $this->hashPassword($entity);
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
        $entity = $this->hashPassword($entity);
        $this->_em->merge($entity);
        $this->_em->flush();
        //@TODO try catch check if email is unique value then return a formatted response at moment returns geenri sql error
        return $entity;
    }

    /**
     * @param Entity $entity
     * @return Entity
     */
    public function hashPassword(Entity $entity)
    {
        $unHashedPass = $entity->getPassword();
        $entity = $entity->setPassword(app()->make('hash')->make($unHashedPass));
        return $entity;
    }
}