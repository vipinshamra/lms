<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lob extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'name', 'description', 'status', 'created_at', 'updated_at'
    ];


}