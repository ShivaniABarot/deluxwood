<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificationValue extends Model
{
    // protected $dates = ['deleted_at'];
    protected $table='modification_value';
    protected $primaryKey = "modification_value_id ";
}
