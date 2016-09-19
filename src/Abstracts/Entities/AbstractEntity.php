<?php

namespace ApiArchitect\Compass\Abstracts\Entities;

use Doctrine\ORM\Cache;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Util\ClassUtils;
use Gedmo\Mapping\Annotation as Gedmo;
use LaravelDoctrine\ACL\Roles\HasRoles;
use LaravelDoctrine\ACL\Mappings as ACL;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use ApiArchitect\Compass\Libraries\EntityTrait;
use ApiArchitect\Compass\Contracts\EntityContract;
use LaravelDoctrine\ORM\Facades\EntityManager;
use ApiArchitect\Compass\Repositories\NodeRepository;

/**
 * Class AbstractNode
 *
 * @package app\Entities
 * @author James Kirkby <hello@jameskirkby.com>
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractEntity
{
    /**
     * @var
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    protected $id;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="Node",fetch="EAGER")
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    protected $nid;


    /**
     * @var string
     */
    public $nodeType;

    /**
     * @return string
     */
    public function getNodeType()
    {
        return $this->nodeType;
    }

    /**
     * @param $nodeType
     * @return $this
     */
    public function setNodeType($nodeType)
    {
        $this->nodeType = $nodeType;
        return $this;
    }
}