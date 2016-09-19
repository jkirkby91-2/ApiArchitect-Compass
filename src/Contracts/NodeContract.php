<?php

namespace ApiArchitect\Compass\Contracts;

/**
 * Interface NodeContract
 *
 * @package app\Entities
 * @author James Kirkby <me@jameskirkby.com>
 */
interface NodeContract
{
//    /**
//     * @ORM\PrePersist
//     * @param $event
//     * @return
//     */
//    public function prePersist($event);
//
//    /**
//     * @ORM\PreUpdate
//     */
//    public function preUpdate();

    /**
     * @return mixed
     */
    public function getContentChangedBy();

    /**
     * Sets createdFromIp.
     *
     * @param string $createdFromIp
     *
     * @return $this
     */
    public function setCreatedFromIp($createdFromIp);

    /**
     * Returns createdFromIp.
     * @return string
     */
    public function getCreatedFromIp();

    /**
     * Sets updatedFromIp.
     *
     * @param string $updatedFromIp
     *
     * @return $this
     */
    public function setUpdatedFromIp($updatedFromIp);

    /**
     * Returns updatedFromIp.
     * @return string
     */
    public function getUpdatedFromIp();

    /**
     * @return DateTime
     */
    public function getDeletedAt();

    /**
     * @param \DateTime|null $deletedAt
     * @return mixed
     */
    public function setDeletedAt(\DateTime $deletedAt = null);

    /**
     * Restore the soft-deleted state
     */
    public function restore();

    /**
     * @return bool
     */
    public function isDeleted();

    /**
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * @return DateTime
     */
    public function getUpdatedAt();

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt);
}