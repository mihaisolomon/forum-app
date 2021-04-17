<?php
namespace App\GraphQl\Types;

use App\Models\User;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class UserType extends GraphQLType {

    protected $attributes = [
        'name'          => 'User',
        'description'   => 'A User',
        'model'         => User::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the user',
            ],
            'name' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the user',
            ],
            'email' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Email of the user',
            ],
        ];
    }
}
