<?php

namespace Tests\Feature\tasks;

use App\Models\Stage;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_stage_on_a_task()
    {
        $initialStage = Stage::factory()->create();
        $updatedStage = Stage::factory()->create();

        $task = Task::factory()->create([
            "stage_id" => $initialStage->id,
        ]);

        $response = $this->post(route('tasks.update', $task),[
            "stage_id" => $updatedStage->id,
        ]);

        $this->assertDatabaseHas('tasks',[
            "id" => $task->id,
            "stage_id" => $updatedStage->id,
        ]);
    }
}
