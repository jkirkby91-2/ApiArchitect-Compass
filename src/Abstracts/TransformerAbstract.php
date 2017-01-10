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
abstract class TransformerAbstract extends SuperAbstract
{
    /**
     * @param $object
     * @return static
     */
    protected function doTransform($object){}
    /**
     * Wraps a endpoint response object, into a standardised format
     */
    public function abstractResponseFormat($responseObject)
    {
        return Collection::make([
            'data' => $responseObject
        ]);
    }
}