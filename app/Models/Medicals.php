<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicals extends Model
{
    use HasFactory;
    // public $timestamps = false;
    // protected $guarded = [];
    protected $table = 'medicals';

    protected $hidden = [
        'spot_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
