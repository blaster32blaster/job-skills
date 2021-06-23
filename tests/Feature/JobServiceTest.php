<?php

namespace Tests\Feature;

use App\Services\JobSearchService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class JobServiceTest extends TestCase
{
    use DatabaseMigrations;

    public $searchService;

    public function setUp() : void
    {
        parent::setUp();
        $this->searchService = JobSearchService::init('');
    }

    /**
     * test the fetch method
     *
     * @return void
     */
    public function testFetch()
    {
        $response = $this->searchService->fetch();
        $this->assertEquals('Software Engineer', $response->first()->title);
        $this->assertNotEmpty($response->first()->skills);
    }


}
