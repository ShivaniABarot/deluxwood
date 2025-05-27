<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DraftProduct extends Model
{
     use SoftDeletes;
    protected $table='draft_product';
    protected $primaryKey = "draft_product_id";
}
