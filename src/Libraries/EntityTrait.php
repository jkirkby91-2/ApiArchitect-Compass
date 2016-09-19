<?php

namespace ApiArchitect\Compass\Libraries;

use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use LaravelDoctrine\ORM\Facades\EntityManager;
use ApiArchitect\Compass\Repositories\NodeRepository;

/**
 * Class EntityTrait
 *
 * @package app\Libraries
 * @author James Kirkby <hello@jameskirkby.com>
 */
trait EntityTrait
{

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNid()
    {
        return $this->nid;
    }

    /**
     * @param $nid
     * @return $this
     */
    public function setNid($nid)
    {
        $this->nid = $nid;
        return $this;
    }
}