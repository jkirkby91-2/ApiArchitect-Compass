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
     * @ORM\Column(type="string", length=299, nullable=false)
     */
    protected $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}