<?php

namespace ApiArchitect\Compass\Repositories;

use ApiArchitect\Compass\Entities\Node;
use ApiArchitect\Compass\Abstracts\Repositories\AbstractRepository;

/**
 * Class NodeRepository
 *
 * @package app\Repositories\Core\Node
 * @author James Kirkby <hello@jameskirkby.com>
 */
class NodeRepository extends AbstractRepository
{

    /**
     * @param array $data
     * @return Node
     */
    public function create(array $data)
    {
        $node = new Node();
        $node->setNodeType($data['nodeType']);
        $this->_em->persist($node);
        $this->_em->flush();
        return $node;
    }

    /**
     * @param int $id
     * @param array $data
     * @return null|object
     */
    public function update($id,array $data)
    {
        $entity = $this->find($id);
        $this->_em->persist($entity);
        $this->_em->flush();
        return $entity;
    }
}