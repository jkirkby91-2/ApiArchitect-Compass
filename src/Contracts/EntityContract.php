<?php

namespace ApiArchitect\Compass\Contracts;

use ApiArchitect\Compass\Contracts\NodeContract;

/**
 * Interface EntityContract
 *
 * @package app\Contracts
 * @author James Kirkby <me@jameskirkby.com>
 */
interface EntityContract
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getNid();

    /**
     * @param $nid
     * @return mixed
     */
    public function setNid($nid);

    /**
     * @return mixed
     */
    public function getNodeType();

    /**
     * @param $nodeType
     * @return mixed
     */
    public function setNodeType($nodeType);

    /**
     * @ORM\PrePersist
     * @param $event
     */
    public function prePersist($event);

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate();
}