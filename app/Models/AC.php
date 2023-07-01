<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AC extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ac';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
