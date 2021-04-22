<?php

namespace App\GraphQl\Types\Forum;

use App\Models\Reply as ReplyModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class Reply extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Reply',
        'description'   => 'A Reply',
        'model'         => ReplyModel::class,
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
                'description'   => 'Creator of the reply',
            ],
            'thread' => [
                'type'          => Type::nonNull(GraphQL::type('Thread')),
                'description'   => 'Replied to the thread',
            ],
        ];
    }
}
