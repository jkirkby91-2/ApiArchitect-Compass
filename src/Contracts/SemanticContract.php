<?php

namespace ApiArchitect\Compass\Contracts;

/**
 * Class SemanticContract
 *
 * @package app\Contracts
 * @author James Kirkby <me@jameskirkby.com>
 */
interface SemanticContract
{

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);
}