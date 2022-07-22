<?php

namespace Tests\Feature\Stage;

use App\Models\Stage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_stages()
    {
        $stages = Stage::factory(2)->create();
        $response = $this->get('/api/stages');

        $response->assertStatus(200);

        $returnedStages = collect($response->original);
        self::assertCount(2, $returnedStages);

        $stages->each(function ($stage, $index) use ($returnedStages) {
            self::assertEquals($stage->description, $returnedStages[$index]['description']);
        });
    }
}
