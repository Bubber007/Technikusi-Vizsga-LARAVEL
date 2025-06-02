<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commander extends Model
{
    protected $table = 'mission_commanders';
    protected $primaryKey = 'mission_id';
    protected $guarded = [];
    public $timestamps = false;
     protected $hidden = [
        'mission_id',
    ];

    /**
     * Get the mission that owns the Commander
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class, 'mission_id', '_id');
    }
}
