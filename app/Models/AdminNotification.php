<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
