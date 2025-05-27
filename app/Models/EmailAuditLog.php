<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAuditLog extends Model
{
     
    protected $table='email_audit_log';
    protected $primaryKey = "id";
}
