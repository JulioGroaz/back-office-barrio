<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiSiamo extends Model
{
    protected $table = 'chi_siamos';

    use HasFactory;
    use SoftDeletes;
}
