<?php

namespace ApiArchitect\Compass\Entities;

use ApiArchitect\Compass\Contracts\EntityContract;
use ApiArchitect\Compass\Libraries\EntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiArchitect\Compass\Contracts\SemanticContract;
use ApiArchitect\Compass\Abstracts\Entities\AbstractEntity;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use LaravelDoctrine\ORM\Facades\EntityManager;
use ApiArchitect\Compass\Repositories\NodeRepository;
/**
 * Class Thing
 *
 * @package ApiArchitect\Entities
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Thing extends AbstractEntity implements SemanticContract
{

    /**
     * @Gedmo\Versioned
     * @Gedmo\Blameable(on="create")
     * @Gedmo\IpTraceable(on="create")
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $name;

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

    /**
     * @ORM\PrePersist
     * @param $event
     */
    public function prePersist($event)
    {
        $em = app()->make('em');
        $entity = $event->getEntity();
        $this->node = $em->getRepository('ApiArchitect\Compass\Entities\Node')->create(['nodeType' => $entity->nodeType]);
        $this->setNid($this->node->getId());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->node = $this->_em->getRepository('app\Entities\Node')->update($this->nid,[]);
    }
}