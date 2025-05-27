<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='product_category';
    protected $primaryKey = "category_id";
}
