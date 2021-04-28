<?php
namespace App\GraphQL\Queries\Forum;

use App\Repositories\Threads\ThreadRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL;
use Closure;

class SearchThreads extends Query
{
    protected ThreadRepositoryInterface $threadRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository)
    {
        $this->threadRepository = $threadRepository;
    }

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Thread'))));
    }

    public function args(): array
    {
        return [
            'query' => [
                'name' => 'query',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $this->threadRepository->search($args['query']);
    }
}
