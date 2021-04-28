<?php

namespace App\Repositories\Threads;


use Illuminate\Database\Eloquent\Collection;

interface ThreadRepositoryInterface
{
    public function search(string $query): Collection;
}
