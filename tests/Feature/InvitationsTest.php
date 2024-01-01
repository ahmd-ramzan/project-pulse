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
    public function non_owners_may_not_invite_users()
    {
        $this->actingAs(User::factory()->create())
            ->post(ProjectFactory::create()->path() . '/invitations')
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $userToInvite = User::factory()->create();

        $this->actingAs($project->owner)->post($project->path(). '/invitations', [
            'email' => $userToInvite->email
        ])->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    public function the_email_address_must_be_associated_with_a_valid_project_pulse_account()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path(). '/invitations', [
            'email' => 'nouser@gmail.com'
        ])->assertSessionHasErrors([
            'email' => 'The user you are inviting must have a project pulse account.'
        ]);
    }

    /** @test */
    public function invited_users_may_update_project_details()
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
