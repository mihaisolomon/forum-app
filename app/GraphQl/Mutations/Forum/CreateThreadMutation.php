<?php
namespace App\GraphQL\Mutations\Forum;

use App\Models\Thread;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Str;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;
use Closure;

class CreateThreadMutation extends Mutation
{
    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'channel_id' => [
                'name' => 'channel_id',
                'type' =>  Type::nonNull(Type::int()),
            ],
            'body' => [
                'name' => 'body',
                'type' =>  Type::nonNull(Type::string()),
            ],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'title' => [
                'required'
            ],
            'channel_id' => [
                'required',
            ],
            'body' => [
                'required', 'string', 'min:5'
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $thread = new Thread();

        $args['user_id'] = auth()->user()->id;
        $args['slug'] = Str::slug($args['title']);

        $thread->fill($args);

        $thread->save();

        return $thread;
    }

    public function type(): Type
    {
        return GraphQL::type('Thread');
    }
}
