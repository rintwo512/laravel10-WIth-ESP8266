<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartAC extends Model
{
    use HasFactory;
    protected $table = 'chartac';
    protected $fillable = [
        'tahun',
        'bulan',
        'total'
    ];

    // public $timestamps = false;

}
