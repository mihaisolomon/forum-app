<?php
namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{
    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' =>  Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = new User();

        $user->fill($args);
        $user->save();

        return $user;
    }

    public function rules(array $args = []): array
    {
        return [
            'name' => [
                'required', 'max:50'
            ],
            'email' => [
                'required', 'email', 'unique:users,email',
            ],
            'password' => [
                'required', 'string', 'min:5'
            ],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('User');
    }
}
