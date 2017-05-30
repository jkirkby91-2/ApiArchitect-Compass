<?php

namespace ApiArchitect\Http\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract as SuperAbstract;
use Jkirkby91\Boilers\RestServerBoiler\TransformerContract;

/**
 * Class TransformerAbstract
 *
 * @package ApiArchitect\Api
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class AbstractTransformer extends SuperAbstract implements TransformerContract
{
    /**
     * @param $object
     * @return static
     */
    abstract protected function transform($object);
}
