<?php

namespace App\GraphQL\Schemas;

use App\GraphQL\Mutations\Forum\CreateReplyMutation;
use App\GraphQL\Mutations\Forum\CreateThreadMutation;
use App\GraphQL\Queries\Profile\Me;
use App\GraphQL\Queries\Forum\SearchThreads;
use App\GraphQl\Types\Forum\Channel;
use App\GraphQl\Types\Forum\Reply;
use App\GraphQl\Types\Forum\Thread;
use App\GraphQl\Types\UserType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class AuthSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
       return [
           'query' => [
               'myProfile' => Me::class,
               'searchThreads' => SearchThreads::class
           ],
           'mutation' => [
               'createThread' => CreateThreadMutation::class,
               'createReply' => CreateReplyMutation::class
           ],
           'types' => [
               'User' => UserType::class,
               'Channel' => Channel::class,
               'Thread' => Thread::class,
               'Reply' => Reply::class,
           ],
           'middleware' => ['auth:api'],
           'method' => ['get', 'post'],
       ];
    }
}
