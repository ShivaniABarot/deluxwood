<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftProductModification extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='draft_product_modification';
    protected $primaryKey = "draft_product_modification_id";
}
