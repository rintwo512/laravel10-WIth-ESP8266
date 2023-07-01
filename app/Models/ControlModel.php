<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlModel extends Model
{
    use HasFactory;
    protected $table = "tbcontrol";
    protected $primayKey = "id";
    protected $fillabel = "data";
}
