<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * complete the task
     * @return void
     */
    public function complete(): void
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    /**
     * incomplete the task
     * @return void
     */
    public function incomplete(): void
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @param $description
     * @return void
     */
    public function recordActivity($description): void
    {
        $this->activity()->create([
            'project_id' => $this->project_id,
            'description' => $description
        ]);
    }

    public function activity(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
