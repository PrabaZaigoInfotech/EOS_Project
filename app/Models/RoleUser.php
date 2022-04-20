<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    public function role_details()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
