<?php

namespace App\Repositories\Threads;

use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;

class ThreadRepository implements ThreadRepositoryInterface
{
    protected Thread $model;

    public function __construct(Thread $model)
    {
        $this->model = $model;
    }

    public function search(string $query): Collection
    {
        $query = $this->fullTextWildcards($query);

        return $this->model->search($query)->get();
    }

    /**
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards(string $term): string
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if(strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode( ' ', $words);

        return $searchTerm;
    }
}
