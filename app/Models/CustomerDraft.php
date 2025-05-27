<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerDraft extends Model
{
    //use SoftDeletes;
    protected $table='customer_draft';
    protected $primaryKey = "customer_draft_id";
}
