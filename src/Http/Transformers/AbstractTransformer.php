<?php

namespace ApiArchitect\Abstracts;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract as SuperAbstract;

/**
 * Class TransformerAbstract
 *
 * @package ApiArchitect\Api
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class AbstractTransformer extends SuperAbstract
{
    /**
     * @param $object
     * @return static
     */
    abstract protected function transform($object);
}
