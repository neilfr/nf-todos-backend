<?php

namespace Tests\Feature\Task;

use App\Models\Stage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_new_task()
    {
        $stage = Stage::factory()->create();
        $payload = [
            "description" => "my task",
            "priority" => 1,
            "stage_id" => $stage->id,
        ];

        $response = $this->post(route('api.tasks.store'),$payload);

        $this->assertDatabaseHas('tasks',$payload);
    }

    /**
     * @test
     * @dataProvider taskStoreValidationProvider
     */
    public function it_has_errors_when_payload_is_not_valid($key, $value)
    {
        $stage = Stage::factory()->create();
        $validPayload = [
            "description" => 'task description',
            "priority" => 'is not a valid priority',
            "stage_id" => $stage->id,
        ];

        $payload = array_merge( $validPayload, [$key => $value]);

        $response = $this->post(route('api.tasks.store'),$payload);

        $response->assertSessionHasErrors($key);
    }

    public function taskStoreValidationProvider()
    {
        return [
            'it errors with invalid priority' => ['priority', 'invalid priority'],
            'it errors with invalid stage_id' => ['stage_id', 'invalid stage_id'],
            'it errors with invalid description' => ['description', []],
        ];
    }
}
