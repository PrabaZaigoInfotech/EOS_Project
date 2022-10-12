<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institution;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = ['institution_id','image_svg','image_json'];
    protected $table = 'certificate';
      public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_name', 'institution_name');
    }
}
