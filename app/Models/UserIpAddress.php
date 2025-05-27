<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIpAddress extends Model
{
   
    protected $table='user_ip_address';
    protected $primaryKey = "user_ip_address_id";
}
