<?php

namespace App\Services;

/**
 * get unique combinations
 */
class CombinationService
{
    /**
     * the array of vals
     *
     * @var array values
     */
    protected $values;

    /**
     * the min length
     *
     * @var int $minLength
     */
    protected $minLength;

    /**
     * the max length
     *
     * @var int $maxLength
     */
    protected $maxLength;

    public function __construct(array $values, $minLength = 1, $maxLength = 1000)
    {
        $this->values = $values;
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    /**
     * fetch all unique combos of the values arrya
     *
     * @return array   unique combos
     */
    public function fetch() : array
    {
        $count = count($this->values);
        $size = pow(2, $count);
        $keys = array_keys($this->values);
        $return = [];

        for($i = 0; $i < $size; $i ++) {
            $b = sprintf("%0" . $count . "b", $i);
            $out = [];

            for($j = 0; $j < $count; $j ++) {
                if ($b[$j] == '1') {
                    $out[$keys[$j]] = $this->values[$keys[$j]];
                }
            }

            if (count($out) >= $this->minLength && count($out) <= $this->maxLength) {
                 $return[] = $out;
            }
        }

        return $return;
    }
}
