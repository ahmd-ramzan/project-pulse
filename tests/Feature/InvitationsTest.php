<?php

namespace Tests\Feature;

use App\Http\Controllers\ProjectTasksController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();
        // given that i have a project
        // and the owner of project invites another user
        $project->invite($newUser = User::factory()->create());

        // then new user have permission to add new tasks
        $this->signIn($newUser);
        $this->post(action([ProjectTasksController::class, 'store'], ['project' => $project]), $task = [
            'body' => 'Foo task'
        ]);

        $this->assertDatabaseHas('tasks', $task);
    }
}
