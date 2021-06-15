<?php
  
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Reserva extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'dia' => $this->dia,
            'mes' => $this->mes,
            'hora_comienzo' => $this->hora_comienzo,
            'hora_fin' => $this->hora_fin,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
    
}
