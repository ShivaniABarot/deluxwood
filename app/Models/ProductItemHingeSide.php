<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItemHingeSide extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='product_item_hinge_side';
    protected $primaryKey = "product_item_hinge_side_id";
}
