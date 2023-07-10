<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;
    protected $table = 'acara';

    protected $fillable = ['penyelenggara','tema_acara', 'lokasi_acara', 'waktu_mulai', 'waktu_berakhir','keterangan'];
}
