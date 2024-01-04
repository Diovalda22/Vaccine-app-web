<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinations extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'dose',
        'date',
        'society_id',
        'spot_id',
        'vaccine_id',
        'doctor_id',
        'officer_id',
    ];

    public function societies() {
        return $this->belongsTo(societies::class, 'society_id');
    }

    public function spots()
    {
        return $this->belongsTo(Spots::class);
    }

    public function vaccines()
    {
        return $this->belongsTo(Vaccines::class);
    }

    public function vaccinator()
    {
        return $this->belongsTo(Medicals::class, 'doctor_id');
    }
}
