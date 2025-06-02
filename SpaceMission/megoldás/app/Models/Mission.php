<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mission extends Model
{
    protected $table = 'missions';
    protected $primaryKey = '_id';
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = ['_id', 'agency_id'];

    /**
     * Get the agency that owns the Mission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id', '_id');
    }

    /**
     * Get the commander associated with the Mission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function commander(): HasOne
    {
        return $this->hasOne(Commander::class, 'mission_id', '_id');
    }
}
