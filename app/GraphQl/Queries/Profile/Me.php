<?php
namespace App\GraphQL\Queries\Profile;

use App\GraphQl\Middleware\Auth;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Closure;
use GraphQL;
use Rebing\GraphQL\Support\Query;

class Me extends Query
{
    protected $attributes = [
        'name'  => 'user',
    ];

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return auth()->user();
    }

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('User'));
    }

    public function args(): array
    {
        return [

        ];
    }
}
