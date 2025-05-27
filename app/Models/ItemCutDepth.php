<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCutDepth extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='item_cut_depth';
    protected $primaryKey = "item_depth_id";
}
