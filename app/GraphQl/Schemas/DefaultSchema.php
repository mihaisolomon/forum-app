<?php
namespace App\GraphQL\Schemas;

use App\GraphQL\Mutations\Auth\Login;
use App\GraphQL\Mutations\CreateUserMutation;
use App\GraphQl\Queries\UserQuery;
use App\GraphQL\Queries\UsersQuery;
use App\GraphQL\Types\AuthPayload;
use App\GraphQL\Types\UserType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class DefaultSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            'query' => [
                'user' => UserQuery::class,
                'users' => UsersQuery::class,
            ],
            'mutation' => [
                'createUser' => CreateUserMutation::class,
                'loginUser' => Login::class,
            ],
            'types' => [
                'User' => UserType::class,
                'AuthPayload' => AuthPayload::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ];
    }
}
