<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDoorStyle extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='product_door_style';
    protected $primaryKey = "product_door_style_id";
}
