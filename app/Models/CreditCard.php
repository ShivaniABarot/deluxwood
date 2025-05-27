<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
     
    protected $table='customer_credit_card';
    protected $primaryKey = "customer_credit_card_id";
}
