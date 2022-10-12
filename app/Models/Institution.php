<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;

class Institution extends Model
{
    use HasFactory;
    protected $fillable = ['institution_name','logo','signature'];
    protected $table = 'institution';
       public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'institution_name', 'institution_name');
    }
}
