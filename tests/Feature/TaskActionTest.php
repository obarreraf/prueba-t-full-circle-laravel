<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class IndexTaskActionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->tasks = Task::factory()->count(5)->create();
    }

    /** @test */
    public function list_all_tasks()
    {
        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    /** @test */
    public function returns_no_tasks_found()
    {
        Task::query()->delete();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(404);
        $response->assertJson(['message' => 'No tasks found']);
    }

    /** @test */
    public function success_register_new_task()
    {
        $response = $this->postJson('/api/tasks',[
            'title' => 'Test Task',
            'description' => 'Description of the test task',
            'status' => 'completed'
        ]);

        $response->assertStatus(201)
                ->assertJson([
                    'title' => 'Test Task',
                    'description' => 'Description of the test task',
                ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'Description of the test task',
        ]);
    }

    /** @test */
    public function error_register_new_task()
    {
        $response = $this->postJson('/api/tasks',[]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['title', 'description']);
    }

    /** @test */
    public function success_update_task_status()
    {
        $taskUpdate = Task::factory()->create(['status' => 'pending']);
        $response = $this->putJson('/api/tasks/'.$taskUpdate->id, [
            'status' => 'completed',
        ]);

        $taskUpdate->refresh();

        $response->assertStatus(200);

        $this->assertEquals('completed', $taskUpdate->status);
    }

    /** @test */
    public function error_update_task_status()
    {
        $response = $this->putJson('/api/tasks/'.$this->tasks[1]->id,[
            'status' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['status']);

    }

}
