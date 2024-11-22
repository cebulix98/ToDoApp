<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SharedTask extends Model
{
    protected $fillable = ['token', 'task', 'validTo'];

    public function taskk(): BelongsTo
    {
        return $this->belongsTo(related: task::class, foreignKey: 'id', ownerKey: 'task');
    }
}
