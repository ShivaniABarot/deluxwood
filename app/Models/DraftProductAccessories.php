<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftProductAccessories extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='draft_product_accessories';
    protected $primaryKey = "draft_product_accessories_id";
}
