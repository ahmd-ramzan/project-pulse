<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            Project::factory()->raw()
        );

        $this->post($project->path().'/tasks', ['body' => 'Test task']);

        $this->get($project->path())->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            Project::factory()->raw()
        );

        $task = $project->addTask('test task');

        $this->patch($project->path().'/tasks/'.$task->id, [
            'body' => 'changed',
            'completed' => 1
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    public function only_the_owner_of_project_can_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path().'/tasks', ['body' => 'Test Task'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
    }

    /** @test */
    public function only_the_owner_of_project_may_update_task()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $task = $project->addTask('test task');

        $this->patch($task->path(), ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'changed'
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            Project::factory()->raw()
        );

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('body');
    }
}