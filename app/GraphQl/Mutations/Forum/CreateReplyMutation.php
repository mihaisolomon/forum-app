<?php

namespace App\GraphQL\Mutations\Forum;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;
use Closure;

class CreateReplyMutation extends Mutation
{
    public function args(): array
    {
        return [
            'thread_id' => [
                'name' => 'thread_id',
                'type' =>  Type::nonNull(Type::int()),
            ],
            'body' => [
                'name' => 'body',
                'type' =>  Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

    }

    public function type(): GraphQLType
    {
        return GraphQL::type('Reply');
    }
}
