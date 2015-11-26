<?php
/**
 * Created by PhpStorm.
 * User: César
 * Date: 24/11/2015
 * Time: 18:23
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UsersRepositoryFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var AdapterInterface $dbAdapter */
        $dbAdapter = $serviceLocator->get('DbAdapter');
        $usersMapper = new UsersMapper();
        $hydrator = new HydratingResultSet($usersMapper, new UsersEntity());

        $tableGateway = new TableGateway('oauth_users', $dbAdapter, null, $hydrator);

        return new UsersRepository($tableGateway);
    }
}