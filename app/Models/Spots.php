<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spots extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'addres',
        'serve',
        'capacity',
    ];

    public function vaccines () {
        return $this->hasMany(SpotVaccine::class, 'spot_id');
    }
 
    public function spotVaccines ($id, $name) {
        $vaccines = SpotVaccine::where('spot_id', $id)->with('Vaccines')->get();
        foreach( $vaccines as $key => $value){
        if($value->vaccines->name == $name) return true;}

        return false;
    }

    public function regional() {
        return $this->belongsTo(Regionals::class);
    }
}
