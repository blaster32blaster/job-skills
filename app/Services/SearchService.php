<?php

namespace App\Services;

abstract class SearchService
{
    protected $combinations;

    public function __construct(array $combinations)
    {
        $this->combinations = $combinations;
    }

    protected static function initialize(array $combinations) {
        return new self(
            $combinations
        );
    }

    protected function search()
    {
        // foreach ()
    }
}
