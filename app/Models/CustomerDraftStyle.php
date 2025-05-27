<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CustomerDraftStyle extends Model
{
 //   use SoftDeletes;
    protected $table='customer_draft_style';
    protected $primaryKey = "draft_style_id";
}