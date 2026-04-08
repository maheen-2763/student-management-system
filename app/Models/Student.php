<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'age', 'image','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
