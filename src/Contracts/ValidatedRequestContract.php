<?php

namespace ApiArchitect\Compass\Contracts;

use Dingo\Api\Http\Request;

/**
 * Interface RequestContract
 *
 * @package ApiArchitect\Compass\Contracts
 * @author James Kirkby <me@jameskirkby.com>
 */
interface ValidatedRequestContract
{
    /**
     * @return mixed
     */
    public function rules();

    /**
     * @param Request $request
     * @return mixed
     */
    public function validate(Request $request);
}