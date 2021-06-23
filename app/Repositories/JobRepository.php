<?php

namespace App\Repositories;

use App\Models\Job;
use Exception;
use Illuminate\Database\Eloquent\Builder;

/**
 * hanlde job model business logic
 */
class JobRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(resolve(Job::class));
    }

    /**
     * create jobs from parsed csv data
     *
     * @param array $data
     * @param array $config
     * @return void
     */
    public function createFromCsv(array $data, array $config) : void
    {
        foreach ($data['data'] as $index) {
            $company = resolve(CompanyRepository::class)
                ->findBy('name', $index[$config['company_name']])
                ->first();
            try {
                $this->store(
                    [
                        'external_posting_id' => $index[$config['external_posting_id']],
                        'title' => $index[$config['job_title']],
                        'company_id' => $company->id
                    ]
                );
            } catch (Exception $e) {
                logger()->error('failure to create job from csv', [
                    'class' => 'JobRepository',
                    'title' => $index[$config['job_title']],
                    'message' => $e->getMessage(),
                    'stack' => $e->getTraceAsString()
                ]);
            }
        }
    }

    /**
     * return query with eager loaded skills and company data
     *
     * @return Builder
     */
    public function defaultCompanySkillQuery() : Builder
    {
        return $this->query()
            ->with('company')
            ->with('skills');
    }
}
