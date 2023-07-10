<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'slug', 'data_target', 'status'];

    public function submenus()
    {
        return $this->hasMany(Submenu::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'menu_user')
            ->withPivot('status')
            ->withTimestamps();
    }
}
