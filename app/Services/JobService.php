<?php

namespace App\Services;

use App\Repositories\JobRepository;
use Illuminate\Support\Collection;

/**
 * handle job response business logic
 */
class JobService
{
    /**
     * a JobRepository instance
     *
     * @var JobRepository $repo
     */
    protected $repo;

    public function __construct()
    {
        $this->repo = resolve(JobRepository::class);
    }

    /**
     * handle index logic
     *
     * @return Collection all of the jobs
     */
    public function index(string $s = null) : Collection
    {
        return JobSearchService::init($s)->fetch();
    }
}
