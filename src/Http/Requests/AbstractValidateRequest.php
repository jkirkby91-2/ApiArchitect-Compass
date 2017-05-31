<?php

namespace ApiArchitect\Compass\Http\Requests;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AbstractMiddleware
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class AbstractValidateRequest extends \Jkirkby91\LumenRestServerComponent\Http\Requests\AbstractValidateRequest
{
  abstract public function rules(ServerRequestInterface $request);
}
