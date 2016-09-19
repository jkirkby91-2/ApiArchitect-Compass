<?php

namespace ApiArchitect\Compass\Repositories;

use ApiArchitect\Compass\Entities\User;
use ApiArchitect\Compass\Abstracts\Repositories\AbstractRepository;
use Illuminate\Hashing\BcryptHasher;

/**
 * Class UserRepository
 *
 * @package app\Repositories\Dog
 * @author James Kirkby <hello@jameskirkby.com>
 */
class UserRepository extends AbstractRepository
{

    /**
     * @param array $user
     * @return User|array
     */
    public function create(array $user)
    {
        $userEntity = new User($user['email'],$user['password']);
        $userEntity->setUserName($user['username']);
        $userEntity->setEmail($user['email']);
        $userEntity->setPassword((new BcryptHasher)->make($user['password']));
        $this->_em->persist($userEntity);
        $this->_em->flush();
        //@TODO try catch check if email is unique value then return a formatted response at moment returns geenri sql error
        return $userEntity;
    }
    /**
     * @param int $id
     * @param array $data
     * @return null|object
     */
    public function update($id,array $data)
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