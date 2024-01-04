<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotVaccine extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function Spots() {
    //     return $this->belongsTo(Spots::class, 'spot_id');
    // }

    public function Vaccines() {
        return $this->hasOne(Vaccines::class, 'id','vaccine_id');
    }
}
