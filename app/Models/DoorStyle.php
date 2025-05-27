<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoorStyle extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='door_style';
    protected $primaryKey = "doorStyle_id";
    protected $fillable = ['name', 'line', 'description', 'assemble_options', 'image'];
}
