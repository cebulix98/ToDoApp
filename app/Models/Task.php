<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'deadline', 'priority', 'status', 'user'];

    public function useraa(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user');
    }

    public function shareToken(): HasOne
    {
        return $this->hasOne(related: SharedTask::class, foreignKey: 'task', localKey: 'id');
    }
}
