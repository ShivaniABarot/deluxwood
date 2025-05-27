<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerifications extends Model
{
    
    protected $table='email_verifications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'email',
        'otp',
        'created_at'
    ];
}