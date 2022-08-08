<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_a_task()
    {
        $task = Task::factory()->create();
        $this->assertDatabaseHas('tasks', $task->toArray());

        $response = $this->delete(route('api.tasks.destroy',$task));

        $this->assertDatabaseMissing('tasks', $task->toArray());
    }
}
