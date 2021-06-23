<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * skill matching trait
 */
trait HasSkillMatches
{

    /**
     * loop through items and modify query
     *
     * @param Builder $query
     * @param array $entry
     * @return Builder   the modified query
     */
    public function handleMultiple(Builder $query, array $entry) : Builder
    {
        for ($j = 0; $j < count($entry); $j++) {

            $query = $this->singleSkillMatchQuery(
                $query,
                $entry[$j]
            );
        }
        return $query;
    }

    /**
     * add filters to inidividual queries
     *
     * @param Builder $query
     * @param Job $item
     * @return Builder
     */
    public function singleSkillMatchQuery(Builder $query, array $item) : Builder
    {
        return (clone $query)
            ->whereHas('skills', function ($q) use ($item) {
                $q->where('title', '=', $item['title']);
            });
    }
}
