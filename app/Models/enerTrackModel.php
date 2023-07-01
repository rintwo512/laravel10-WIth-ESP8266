<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enerTrackModel extends Model
{
    use HasFactory;
    protected $table = "tbsensor";
    protected $primayKey = "id";
    protected $fillabel = ["suhu", "kelembapan"];
}
