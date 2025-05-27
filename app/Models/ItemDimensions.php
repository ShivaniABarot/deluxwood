<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDimensions extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='item_dimensions';
    protected $primaryKey = "item_dimensions_id";
}
