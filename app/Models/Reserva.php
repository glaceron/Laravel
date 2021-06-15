<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user',
        'dia',
        'mes',
        'hora_comienzo',
        'hora_fin'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
