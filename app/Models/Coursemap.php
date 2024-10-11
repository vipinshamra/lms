<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coursemap extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'user_id', 'course_id', 'lob_id', 'quiz_status', 'assignment_status', 'assignment_file', 'assignment_remark', 'assignment_download_status', 'created_at', 'updated_at'	
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }


}
