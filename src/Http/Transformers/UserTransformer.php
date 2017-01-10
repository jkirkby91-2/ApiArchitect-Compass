<?php

namespace ApiArchitect\Compass\Http\Transformers;

/**
 * Class UserTransformer
 *
 * @package ApiArchitect\Compass\Http\Transformers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
class UserTransformer extends \League\Fractal\TransformerAbstract implements \Jkirkby91\Boilers\RestServerBoiler\TransformerContract
{
    /**
     * @param $user
     * @return array
     */
    public function transform($user)
    {
        $name = json_decode($user->getName(),true);
        return [
            'status'    => 'success',
            'data' => [
                'avatar'        => 'http://fuuse.net/wp-content/uploads/2016/02/avatar-placeholder.png',
                'name'          => $name['firstname'].' '.$name['lastname'],
                'email'         => $user->getEmail(),
                'username'      => $user->getUserName(),
                'roles'          => ['admin','business']
            ],
        ];
    }

}