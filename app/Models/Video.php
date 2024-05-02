<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'file_path', 'kategori_id', 'user_id', 'description'];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}