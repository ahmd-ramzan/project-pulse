<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    /**
     * @param $description
     * @return void
     */
    public function recordActivity($description): void
    {
        $this->activity()->create(compact('description'));
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

}
