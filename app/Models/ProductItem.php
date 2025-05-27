<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='product_item';
    protected $primaryKey = "product_item_id";
}
