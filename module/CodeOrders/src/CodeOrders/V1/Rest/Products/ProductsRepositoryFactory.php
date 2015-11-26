<?php
/**
 * Created by PhpStorm.
 * User: César
 * Date: 24/11/2015
 * Time: 18:23
 */

namespace CodeOrders\V1\Rest\Products;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductsRepositoryFactory implements FactoryInterface
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
        $productsMapper = new ProductsMapper();
        $hydrator = new HydratingResultSet($productsMapper, new ProductsEntity());

        $tableGateway = new TableGateway('products', $dbAdapter, null, $hydrator);

        return new ProductsRepository($tableGateway);
    }
}