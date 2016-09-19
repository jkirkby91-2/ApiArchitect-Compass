<?php

namespace ApiArchitect\Compass\Http\Requests;

use Dingo\Api\Http\Request;
use ApiArchitect\Compass\Contracts\ValidatedRequestContract;

/**
 * Class UserRequest
 *
 * @package Api\Requests
 * @author James Kirkby <hello@jameskirkby.com>
 */
class UserRequest implements ValidatedRequestContract
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author James Kirkby <hello@jameskirkby.com>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:ApiArchitect\CompassEntities\User,email',
            'username' => 'required|max:255|unique:ApiArchitect\CompassEntities\User,username',
            'password' => 'required|confirmed|min:8',
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function validate(Request $request)
    {
       $validator = app()->make('validator');
        $validator->validate();
    }
}