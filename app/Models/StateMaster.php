<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateMaster extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='state_master';
    protected $primaryKey = "state_id";
}
