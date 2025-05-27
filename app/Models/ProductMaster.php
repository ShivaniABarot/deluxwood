<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMaster extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='product_master';
    protected $primaryKey = "product_id";
}
