<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $project->recordActivity('created');
    }

    /**
     * Handle the project "updating" event.
     * @return void
     */
    public function updating(Project $project)
    {
        $project->old = $project->getOriginal();
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        $project->recordActivity('updated');
    }
}
