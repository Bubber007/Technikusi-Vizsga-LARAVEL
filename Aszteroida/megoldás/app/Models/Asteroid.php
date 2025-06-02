<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Asteroid extends Model
{
    protected $table = 'asteroids';
    protected $primaryKey = '_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $hidden = ['_id', 'corporation_id'];

    /**
     * Get the corporation that owns the Asteroid
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporation(): BelongsTo
    {
        return $this->belongsTo(Corporation::class, 'corporation_id', '_id');
    }

    /**
     * Get the leader associated with the Asteroid
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function leader(): HasOne
    {
        return $this->hasOne(Leader::class, 'asteroid_id', '_id');
    }
}
