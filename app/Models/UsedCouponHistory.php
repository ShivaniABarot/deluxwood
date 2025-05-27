<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCouponHistory extends Model
{
     
    protected $table='used_coupon_history';
    protected $primaryKey = "coupon_history_id";
}
