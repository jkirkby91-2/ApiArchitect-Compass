<?php

namespace ApiArchitect\Compass\Repositories;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UserRepository
 *
 * @package app\Repositories\Dog
 * @author James Kirkby <hello@jameskirkby.com>
 */
class UserRepository extends \Jkirkby91\DoctrineRepositories\DoctrineRepository implements \Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract
{
    use \Jkirkby91\DoctrineRepositories\ResourceRepositoryTrait;

    /**
     * @param ServerRequestInterface $request
     * @return \ApiArchitect\Compass\Entities\User
     */
    public function store(ServerRequestInterface $request)
    {
        //@TODO some erro checking/ exception throwing
        $userRegDetails = $request->getParsedBody();

        $userEntity = new \ApiArchitect\Compass\Entities\User($userRegDetails['email'],$userRegDetails['password'],$userRegDetails['name']);
        $userEntity->setUserName($userRegDetails['username']);
        $userEntity->setEmail($userRegDetails['email']);
        $userEntity->setPassword(app()->make('hash')->make($userRegDetails['password']));
//        dd($userEntity);
        $this->_em->persist($userEntity);
        $this->_em->flush();
        //@TODO try catch check if email is unique value then return a formatted response at moment returns geenri sql error
        return $userEntity;
    }

    /**
     * @param ServerRequestInterface $request
     * @param $id
     * @return null|object
     */
    public function update(ServerRequestInterface $request,$id)
    {
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