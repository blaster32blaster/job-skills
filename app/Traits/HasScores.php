<?php

namespace App\Traits;

use App\Models\Job;
use Illuminate\Support\Collection;

/**
 * add scores
 */
trait HasScores
{
        /**
     * add scores to matched jobs
     *
     * @param Collection $matches
     * @return Collection the matches with added scores
     */
    public function addScores(Collection $matches) : Collection
    {

        foreach ($matches as $match) {
            $score = $this->checkSearchTerms($match);
            $match->score = $score;
        }
        $sorted = $matches->sortByDesc('score');
        return $sorted->values();
    }

    /**
     * comapre search terms against matches and add relevancy
     *
     * @param Job $match
     * @return integer
     */
    public function checkSearchTerms(Job $match) : int
    {
        $points = 0;
        foreach ($this->searchTerms as $searchTerm) {
            if ($match
                    ->skills
                    ->pluck('title')
                    ->contains($searchTerm['title']) &&
                array_key_exists('rating', $searchTerm)
            ) {
                $points += $searchTerm['rating'];
            }
        }
        return $points;
    }
}
