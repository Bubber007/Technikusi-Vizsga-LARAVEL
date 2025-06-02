<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    protected $table = 'mining_corporations';
    protected $primaryKey = '_id';
    protected $guarded = [];
    public $timestamps = false;
}
