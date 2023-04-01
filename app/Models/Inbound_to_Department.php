<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbound_to_Department extends Model
{
    use HasFactory;
    protected $primaryKey = "inbound_to_Depart_Id";
    protected $guarded = [];
}
