<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModification extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='item_modification';
    protected $primaryKey = "item_modification_id";
}
