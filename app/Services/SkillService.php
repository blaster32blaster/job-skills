<?php

namespace App\Services;

use App\Repositories\SkillRepository;
use Illuminate\Support\Collection;

/**
 * handle skill response business logic
 */
class SkillService
{
    /**
     * a SkillRepository instance
     *
     * @var SkillRepository $repo
     */
    protected $repo;

    public function __construct()
    {
        $this->repo = resolve(SkillRepository::class);
    }

    /**
     * handle index logic
     *
     * @return Collection all of the skills
     */
    public function index() : Collection
    {
        return $this->repo
            ->query()
            ->get();
    }
}
