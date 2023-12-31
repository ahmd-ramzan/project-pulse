<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    use HasFactory;

    protected $casts = [
        'changes' => 'array'
    ];

    protected $guarded = [];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who triggered the activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
