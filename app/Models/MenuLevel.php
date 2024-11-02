<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuLevel extends Model
{
    use HasFactory;
    protected $table = 'menu_level';
    protected $primaryKey = 'id_level';

    protected $guarded = [

    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_level', 'id_level');
    }
}
