<?php

namespace App\GraphQL\Schemas;

use App\GraphQL\Queries\Profile\Me;
use App\GraphQl\Types\AuthPayload;
use App\GraphQl\Types\UserType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class AuthSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
       return [
           'query' => [
               'myProfile' => Me::class,
           ],
           'mutation' => [

           ],
           'types' => [
               'User' => UserType::class,
           ],
           'middleware' => ['auth:api'],
           'method' => ['get', 'post'],
       ];
    }
}
