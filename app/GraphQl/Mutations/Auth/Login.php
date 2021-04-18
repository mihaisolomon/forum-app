<?php
namespace App\GraphQl\Mutations\Auth;

use App\Models\User;
use App\Services\Passport\PassportService;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;
use Closure;

class Login extends Mutation
{
    protected PassportService $passportService;

    public function __construct(PassportService $passportService)
    {
        $this->passportService = $passportService;
    }

    public function args(): array
    {
        return [
            'username' => [
                'name' => 'username',
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
        $credentials = $this->passportService->buildCredentials($args);

        $response = $this->passportService->makeRequest($credentials);

        $user = User::where('email', $args['username'])->first();

        return array_merge(
            $response,
            [
                'user' => $user,
            ]
        );
    }

    public function rules(array $args = []): array
    {
        return [
            'username' => [
                'required', 'email',
            ],
            'password' => [
                'required', 'string', 'min:5'
            ],
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('AuthPayload');
    }
}
