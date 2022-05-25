<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'youtube',
        'category',
        'tags',
        'type',
        'quantity',
        'description',
        'ingredients',
        'prepare',
        'tips'
    ];
}
