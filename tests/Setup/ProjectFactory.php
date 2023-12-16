<?php

namespace Tests\Setup;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class ProjectFactory
{
    /**
     * The number of tasks for the project.
     *
     * @var int
     */
    protected $tasksCount = 0;
    /**
     * The owner of the project.
     *
     * @var User
     */
    protected $user;

    /**
     * Set the number of tasks to create for the project.
     *
     * @param int $count
     * @return $this
     */
    public function withTasks(int $count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    /**
     * Set the owner of the new project.
     *
     * @param User $user
     * @return $this
     */
    public function ownedBy(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Arrange the world.
     *
     * @return Project
     */
    public function create(): Project
    {
        $project = Project::factory()->create([
            'owner_id' => $this->user ?? User::factory()->create()
        ]);

        Task::factory()->count($this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
