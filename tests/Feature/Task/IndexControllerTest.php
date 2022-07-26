<?php

namespace Tests\Feature\Task;

use App\Models\Stage;
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
        $this->withoutExceptionHandling();
        $tasks = Task::factory(2)->create();
        $response = $this->get('/api/tasks');

        $response->assertStatus(200);

        $returnedTasks = collect($response->original);
        self::assertCount(2,$returnedTasks);

        $tasks->each(function ($task, $index) use ($returnedTasks) {
            self::assertEquals($task->description, $returnedTasks[$index]['description']);
        });
    }

    /** @test */
    public function it_returns_tasks_with_a_stage()
    {
        $stage = Stage::factory()->create();
        $task = Task::factory()->create([
            "stage_id" => $stage->id,
            ]);

        $response = $this->get(route('tasks.index'));

        $returnedTasks = collect($response->original);

        self::assertCount(1,$returnedTasks);
        self::assertEquals($returnedTasks[0]['stage'], $stage->description);
    }
}
