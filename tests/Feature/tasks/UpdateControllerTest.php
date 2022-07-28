<?php

namespace Tests\Feature\tasks;

use App\Models\Stage;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     *  @dataProvider taskUpdateValidationProvider
     */
    public function it_updates_a_task($key, $value)
    {
        $stages = Stage::factory(2)->create();

        $task = Task::factory()->create([
            "stage_id" => $stages[0]->id,
        ]);

        $this->patch(route('tasks.update', $task),[
            $key => $value,
        ]);

        $this->assertDatabaseHas('tasks',[
            "id" => $task->id,
            $key => $value,
        ]);
    }

    public function taskUpdateValidationProvider()
    {
        return [
            'stage_id must be a valid stage id' => ['stage_id', 2],
            'priority must be a number greater than 0' => ['priority', 3],
            'description must be a string' => ['description', 'hello'],
        ];
    }

    /** @test
     *  @dataProvider taskUpdateErrorValidationProvider
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

    public function taskUpdateErrorValidationProvider()
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
