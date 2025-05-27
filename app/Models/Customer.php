<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $dates = ['deleted_at'];
    protected $table='customer';
    protected $primaryKey = "customer_id";
}
