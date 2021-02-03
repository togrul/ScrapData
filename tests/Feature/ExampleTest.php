<?php

namespace Tests\Feature;

use App\Jobs\ScrapDataJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDispachesJob()
    {
        Queue::fake();
        ScrapDataJob::dispatchNow('');
        Queue::assertPushed(ScrapDataJob::class);
    }
}
