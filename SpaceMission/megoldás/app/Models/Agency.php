<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'space_agencies';
    protected $primaryKey = '_id';
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = ['_id'];
}
