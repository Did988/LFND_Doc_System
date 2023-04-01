<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc_Outbound extends Model
{
    use HasFactory;
    protected $primaryKey = 'doc_Id';
    protected $guarded = [];
}
