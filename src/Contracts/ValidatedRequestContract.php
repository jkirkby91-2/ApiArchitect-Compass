<?php

namespace ApiArchitect\Compass\Contracts;

use Psr\Http\Message\ServerRequestInterface;

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
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function validate(ServerRequestInterface $request);
}