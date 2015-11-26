<?php
/**
 * Created by PhpStorm.
 * User: César
 * Date: 24/11/2015
 * Time: 18:09
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class UsersRepository
{
    /**
     * @var TableGatewayInterface
     */
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function create($data)
    {
        $mapper = new UsersMapper();
        $result = $this->tableGateway->insert($mapper->extract($data));

        return $result;
    }

    public function find($id)
    {
        $resultSet = $this->tableGateway->select(['id'=> (int)$id]);

        return $resultSet->current();
    }

    public function findAll()
    {
        $paginatorAdapter = new DbTableGateway($this->tableGateway);
        return new UsersCollection($paginatorAdapter);
    }

    public function update($id, $data)
    {
        $mapper = new UsersMapper();
        return $this->tableGateway->update($mapper->extract($data), ['id' => (int)$id]);
    }

    public function patch($id, $data)
    {
        $mapper = new UsersMapper();
        return $this->tableGateway->update($mapper->extract($data), ['id' => (int)$id]);
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => (int)$id]);
    }
}