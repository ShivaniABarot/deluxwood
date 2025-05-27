<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultShippingCost extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='default_shipping_cost';
    protected $primaryKey = "default_shipping_cost_id";
}
