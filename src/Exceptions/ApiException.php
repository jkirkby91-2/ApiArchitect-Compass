<?php

namespace ApiArchitect\Compass\Exceptions;

/**
 * Class ApiException
 *
 * @package app\Exceptions
 * @author James Kirkby <hello@jameskirkby.com>
 */
class ApiException extends \Exception
{
    /**
     * @param \Exception $e
     */
    public function render(\Exception $e){}
}