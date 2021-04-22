<?php

namespace App\GraphQl\Types\Forum;

use App\Models\Thread as ThreadModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class Thread extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Thread',
        'description'   => 'A Thread',
        'model'         => ThreadModel::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the thread',
            ],
            'slug' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Slug for the thread',
            ],
            'title' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Thread title',
            ],
            'body' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Thread content',
            ],
            'locked' => [
                'type'          => Type::nonNull(Type::boolean()),
                'description'   => 'Is locked',
            ],
            'user' => [
                'type'          => Type::nonNull(GraphQL::type('User')),
                'description'   => 'Creator of the thread',
            ],
            'replies' => [
                'type'          => Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Reply')))),
                'description'   => 'Thread replies',
            ]
        ];
    }
}
