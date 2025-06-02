<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SpaceAgency extends Model
{
     protected $table = 'space_agencies';
    protected $primaryKey = '_id';
    protected $guarded = [];
    protected $hidden=['_id'];

    public $timestamps = false;

}
