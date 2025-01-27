<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Semua field kecuali 'id' dapat diisi

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

