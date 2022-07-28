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

        $this->patch(route('tasks.update', $task),[
            "stage_id" => $updatedStage->id,
        ]);

        $this->assertDatabaseHas('tasks',[
            "id" => $task->id,
            "stage_id" => $updatedStage->id,
        ]);
    }

    /** @test
     *  @dataProvider taskUpdateValidationProvider
     */
    public function it_returns_error_when_payload_not_valid($key, $value)
    {
        $stage = Stage::factory()->create();

        $task = Task::factory()->create([
            "stage_id" => $stage->id,
        ]);

        $payload =  [
          $key => $value,
        ];

        $response = $this->patch(route('tasks.update', $task), $payload);

        $response->assertSessionHasErrors($key);
    }

    public function taskUpdateValidationProvider()
    {
        return [
            'stage_id cannot be a string'=>["stage_id","not a valid stage_id"],
            'stage_id cannot be a number not in the stage id field'=>["stage_id",99],
            'priority cannot be a string'=>["priority","not a valid priority"],
            'priority cannot be less than 1'=>["priority",0],
            'description cannot be an array' => ["description", []],
        ];
    }
}
