<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSession extends Model
{

    use HasFactory;
    protected $table = 'session';
    protected $guarded = ['id'];

    public function userSess()
    {
        return $this->belongsTo(User::class, 'user_id', 'lat', 'long');
    }
}
