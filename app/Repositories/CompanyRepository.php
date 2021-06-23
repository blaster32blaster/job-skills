<?php

namespace App\Repositories;

use App\Models\Company;
use Exception;

/**
 * hanlde company model business logic
 */
class CompanyRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(resolve(Company::class));
    }

    /**
     * create companies from parsed csv data
     *
     * @param array $data
     * @param integer $index
     * @return void
     */
    public function createFromCsvArrayIndex(array $data, int $index) : void
    {
        foreach ($data['data'] as $datum) {
            try {
                $this->store(['name' => $datum[$index]]);
            } catch (Exception $e) {
                logger()->error('failure to create company from csv', [
                    'class' => 'CompanyRepository',
                    'name' => $datum[$index],
                    'message' => $e->getMessage(),
                    'stack' => $e->getTraceAsString()
                ]);
            }
        }
    }
}
