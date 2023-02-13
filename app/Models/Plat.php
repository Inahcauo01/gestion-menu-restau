<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Plat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','nom_menu','description_menu','date_menu','image_menu'
    ];
}
