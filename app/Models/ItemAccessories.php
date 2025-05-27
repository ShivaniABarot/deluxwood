<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAccessories extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='item_accessories';
    protected $primaryKey = "item_accessories_id";
}
