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

        $response->assertJsonFragment([
            'message' => 'The title field is required. (and 2 more errors)',
        ]);

        $response->assertJsonFragment([
            'errors' => [
                'title' => [
                    'The title field is required.'
                ],
                'description' => [
                    'The description field is required.'
                ],
                'status' => [
                    'The status field is required.'
                ],
            ],
        ]);
    }

}
