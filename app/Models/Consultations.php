<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultations extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'society_id',
        'doctor_id',
        'status',
        'disease_history',
        'current_symptoms',
        'doctor_notes',
    ];
    // public function society()
    // {
    //     return $this->belongsTo(societies::class, "society_id");
    // }

    public function doctor()
    {
        return $this->belongsTo(Medicals::class, "doctor_id", "id");
    }
}
