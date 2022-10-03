<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCertificate extends Model
{
    use HasFactory;

    protected $table = "assign_certificate";
    protected $fillable = ['user_id','course_name','date_completion','total_hours'];
}
