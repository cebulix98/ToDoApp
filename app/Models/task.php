<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'deadline', 'priority', 'status', 'user'];

    public function useraa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function shareToken(): HasOne
    {
        return $this->hasOne(SharedTask::class, 'task', 'id');
    }
}
