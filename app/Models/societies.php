<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class societies extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'id_card_number',
        'password',
        'name',
        'born_date',
        'gender',
        'address',
        'regional_id',
        'login_tokens',
    ];

    public function regional() {
        return $this->belongsTo(Regionals::class, 'regional_id');
    }

    public function status() {
        return $this->belongsTo(Consultations::class);
    }
}
