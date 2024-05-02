<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{

    protected $table = 'students';

    protected $fillable = ['user_id', 'bio', 'status'];

    // Tambahan method atau relasi sesuai kebutuhan

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

