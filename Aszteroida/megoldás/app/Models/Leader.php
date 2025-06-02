<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $table = 'operation_leaders';
    protected $primaryKey = 'asteroid_id';
    protected $guarded = [];
    public $timestamps = false;
}
