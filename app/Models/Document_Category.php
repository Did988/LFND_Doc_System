<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_Category extends Model
{
    use HasFactory;
    
    
    protected $primaryKey = 'doc_Category_Id';
    protected $fillable = [
        'category_Name'
    ];
}
