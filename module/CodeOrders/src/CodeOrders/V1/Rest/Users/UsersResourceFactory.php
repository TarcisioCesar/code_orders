<?php
namespace CodeOrders\V1\Rest\Users;

class UsersResourceFactory
{
    public function __invoke($services)
    {
        return new UsersResource($services->get('\CodeOrders\\V1\\Rest\\Users\\UsersRepository'));
    }
}
