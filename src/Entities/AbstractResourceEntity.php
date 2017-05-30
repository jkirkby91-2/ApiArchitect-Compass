<?php

namespace ApiArchitect\Compass\Entities;

use Doctrine\ORM\Mapping as ORM;
use Jkirkby91\DoctrineSchemas\Entities\Thing;
use Jkirkby91\Boilers\SchemaBoilers\SchemaContract;

/**
 * Class Thing
 *
 * @package ApiArchitect\Compass\Entities
 * @author James Kirkby <jkirkby91@gmail.com>
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractResourceEntity extends Thing implements SchemaContract
{

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

}