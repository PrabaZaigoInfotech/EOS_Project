<?php

namespace App\Models\Backend\Badges;

use App\Models\AssignCertificate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Courses\Course;
use App\Models\User;

class Badge extends Model
{
    use HasFactory;
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_name', 'course_name');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

   
}
