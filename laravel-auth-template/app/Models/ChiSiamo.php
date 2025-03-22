<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiSiamo extends Model
{
    protected $table = 'chi_siamos';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path'
    ];
}
