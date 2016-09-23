<?php

namespace ApiArchitect\Compass\Http\Transformers;

/**
 * Class UserTransformer
 *
 * @package ApiArchitect\Compass\Http\Transformers
 */
class UserTransformer extends \League\Fractal\TransformerAbstract implements \Jkirkby91\Boilers\RestServerBoiler\TransformerContract
{

    /**
     * @param $user
     * @return array
     */
    public function transform($user)
    {
        $name = $user->getName();
        return [
            'id'            => (int) $user->getId(),
            'name'          => $name[0].' '.$name[1],
            'email'         => $user->getEmail(),
            'username'      => $user->getUserName(),
        ];
    }

}