<?php

namespace App\GraphQl\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class AuthPayload extends GraphQLType {

    protected $attributes = [
        'name'          => 'AuthPayload',
        'description'   => 'AuthPayload response',
    ];

    public function fields(): array
    {
        return [
            'access_token' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'access token',
            ],
            'refresh_token' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'refresh token',
            ],
            'expires_in' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'expires in',
            ],
            'token_type' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'token type',
            ],
            'user' => [
                'type'          => Type::nonNull(GraphQL::type('User')),
                'description'   => 'User profile',
            ],
        ];
    }
}
