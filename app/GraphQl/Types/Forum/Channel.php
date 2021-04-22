<?php
namespace App\GraphQl\Types\Forum;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Channel as ChannelModel;
use GraphQL;

class Channel extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Channel',
        'description'   => 'A Channel',
        'model'         => ChannelModel::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the channel',
            ],
            'name' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the channel',
            ],
            'slug' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Slug of the channel',
            ],
            'threads' => [
                'type'          => Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Thread')))),
                'description'   => 'Channel threads',
            ]
        ];
    }
}
