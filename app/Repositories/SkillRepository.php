<?php

namespace App\Repositories;

use App\Models\Job;
use App\Models\Skill;
use Exception;

/**
 * handle skill model business logic
 */
class SkillRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(resolve(Skill::class));
    }

    /**
     * create skills from an array in a csv
     *
     * @param array $data
     * @param array $config
     * @return void
     */
    public function createFromArrayInCsv(array $data, array $config) : void
    {
        foreach ($data['data'] as $datum) {
            $company = resolve(CompanyRepository::class)
                ->findBy('name', $datum[$config['company_name']])
                ->first();

            $job = resolve(JobRepository::class)
                ->query()
                ->where('title', '=', $datum[$config['job_title']])
                ->where('company_id', '=', $company->id)
                ->first();

            $skillsAr = explode(',', $datum[$config['skills']]);
            $this->handleSavingSkillArray($skillsAr, $job);
        }
    }

    /**
     * take an array of skills, save
     * then attach to jobs
     *
     * @param array $skills
     * @param Job $job
     * @return void
     */
    public function handleSavingSkillArray(
        array $skills,
        Job $job
    ) : void  {
        foreach ($skills as $skill) {
            $existing = $this->findBy('title', $skill);

            try {
                if ($existing->count() > 0) {
                    $existing->first()->jobs()->sync($job->id);
                    continue;
                }
                $skill = $this->store(
                    [
                        'title' => $skill,
                    ]
                );
                $skill->jobs()->sync($job->id);
            } catch (Exception $e) {
                logger()->error('failure to create job from csv', [
                    'class' => 'SkillRepository',
                    'title' => $skill,
                    'message' => $e->getMessage(),
                    'stack' => $e->getTraceAsString()
                ]);
            }
        }
    }
}
