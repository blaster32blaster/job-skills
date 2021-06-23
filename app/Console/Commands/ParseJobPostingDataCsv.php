<?php

namespace App\Console\Commands;

use App\CsvParsing\Services\CsvFileParser;
use App\Repositories\CompanyRepository;
use App\Repositories\JobRepository;
use App\Repositories\SkillRepository;
use Illuminate\Console\Command;
// app\CsvParsing\Services\CsvFIleParser.php

class ParseJobPostingDataCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv-parse:job-posting-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse the local file job_posting_data.csv';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = CsvFileParser::init(
            storage_path('job_posting_data.csv'),
            ['delimiter' => ',']
        )->run();

        // from here we need to:
        // 1. create comnpanies
        $this->handleCompanies($data);
        // 2. create jobs
        $this->handleJobs($data);
        // 3. create skills
        $this->handleSkills($data);
    }

    /**
     * create companies from the provided csv data
     *
     * @param array $data
     * @return void
     */
    protected function handleCompanies(array $data) : void
    {
        resolve(CompanyRepository::class)
            ->createFromCsvArrayIndex($data, 2);
    }

    /**
     * create jobs from the provided csv ddata
     *
     * @param array $data
     * @return void
     */
    protected function handleJobs(array $data) : void
    {
        resolve(JobRepository::class)
            ->createFromCsv($data, config('csv.job_posting_data_csv.jobs'));
    }

    /**
     * create skills from the provided csv data
     *
     * @param array $data
     * @return void
     */
    protected function handleSkills(array $data) : void
    {
        resolve(SkillRepository::class)
            ->createFromArrayInCsv($data, config('csv.job_posting_data_csv.skills'));
    }
}
