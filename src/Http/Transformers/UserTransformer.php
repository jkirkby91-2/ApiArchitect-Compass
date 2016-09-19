<?php

namespace ApiArchitect\Compass\Http\Transformers;

//use ApiArchitect\Compass\Contracts\TransformerContract;
use ApiArchitect\Compass\Entities\User;
use League\Fractal;

/**
 * Class UserTransformer
 *
 * @package ApiArchitect\Compass\Http\Transformers
 */
class UserTransformer extends Fractal\TransformerAbstract
{

    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'            => (int) $user->getId(),
            'name'          => $user->getName(),
            'email'         => $user->getEmail(),
            'username'      => $user->getUserName(),
            'roles'         => $user->getRoles()
        ];
    }

}