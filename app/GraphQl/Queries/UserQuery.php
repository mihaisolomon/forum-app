<?php
namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;


class UserQuery extends Query
{

    protected $attributes = [
        'name'  => 'user',
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('User'));
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                'min:1',
                'exists:users,id'
            ],
        ];
    }

    public function args(): array
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields)
    {
        return User::findOrFail($args['id']);
    }
}
