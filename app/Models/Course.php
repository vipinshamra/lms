<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Authenticatable
{
    
    use HasFactory, Notifiable;


    protected $fillable = [
        'course_id', 'course_name ', 'description', 'image', 'sme_id', 'lob_id', 'assignment', 'status', 'created_at', 'updated_at'
    ];

    public function module(): HasMany
    {
        return $this->HasMany(Module::class, 'course_id', 'id');
    }

    public function quiz(): HasMany
    {
        return $this->HasMany(Quiz::class, 'course_id', 'course_id');
    }


   
}
