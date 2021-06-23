<?php

namespace App\Services;

use App\Models\Job;
use App\Repositories\JobRepository;
use App\Traits\HasScores;
use App\Traits\HasSkillMatches;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * job search service
 */
class JobSearchService extends SearchService
{
    use HasSkillMatches, HasScores;

    /**
     * the search terms
     *
     * @var ?array $searchTerms
     */
    protected $searchTerms;

    /**
     * a JobRepository instance
     *
     * @var JobRepository $repo
     */
    protected $repo;

    public function __construct(
        ?string $searchTerms,
        JobRepository $repo
    ) {
        $this->searchTerms = $this->setSearchTerms($searchTerms);
        $this->repo = $repo;
    }

    /**
     * init job search service
     *
     * @param string|null $searchTerms
     * @return JobSearchService
     */
    public static function init(?string $searchTerms) : JobSearchService
    {
        return new self(
            $searchTerms,
            resolve(JobRepository::class)
        );
    }

    /**
     * fetch the filtered data
     *
     * @return Collection the sorted and scored jobs
     */
    public function fetch() : Collection
    {
        if (!$this->searchTerms) {
            return $this->repo->defaultCompanySkillQuery()
                ->get();
        }

        $comboService = new CombinationService($this->searchTerms);
        $matches = $this->find($comboService->fetch());
        $scoredMatches = $this->addScores($matches);

        // now we want to push all the others to the end
        $othersQuery = $this->addOthers($scoredMatches);
        return $scoredMatches->merge($othersQuery->get());
    }

    /**
     * loop through unique combinations and fetch data
     *
     * @param array $combos
     * @return Collection
     */
    protected function find(array $combos) : Collection
    {
        $response = collect();
        for ($i = 0; $i < count($combos); $i++) {
            $combos[$i] = array_values($combos[$i]);
            $query = $this->repo->defaultCompanySkillQuery();

            // now we loop through individual items in the combo
            $finalQuery = $this->handleMultiple(
                (clone $query),
                $combos[$i]
            )
            ->get();

            if (!$finalQuery->isEmpty()) {
                $response->push($finalQuery);
            }
        }
        return $response
            ->flatten()
            ->unique();
    }

    /**
     * set the class search terms
     *
     * @param string|null $searchTerms
     * @return array|null
     */
    protected function setSearchTerms(?string $searchTerms) : ?array
    {
        if (!$searchTerms) {
            return null;
        }
        return json_decode($searchTerms, TRUE);
    }

    /**
     * add not matched jobs to response
     *
     * @param Collection $found
     * @return Builder
     */
    protected function addOthers(Collection $found) : Builder
    {
        $ids = $found
            ->pluck('id')
            ->toArray();

        return $this->repo->defaultCompanySkillQuery()
            ->whereNotIn('id', $ids);
    }
}
