<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_tasks()
    {
        $tasks = Task::factory(2)->create();
        $response = $this->get('/api');

        $response->assertStatus(200);

        $returnedTasks = collect($response->original);
        self::assertCount(2,$returnedTasks);

        $tasks->each(function ($task, $index) use ($returnedTasks) {
            self::assertEquals($task->description, $returnedTasks[$index]['description']);
        });

    }
}
