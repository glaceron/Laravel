<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $reserva = new Reserva();

        $reserva->user = "2";
        $reserva->dia = "12";
        $reserva->mes = "6";
        $reserva->hora_comienzo = "12:00";
        $reserva->hora_fin = "13:00";


        $reserva->save();
        
        $reserva1 = new Reserva();

        $reserva1->user = "2";
        $reserva1->dia = "12";
        $reserva1->mes = "7";
        $reserva1->hora_comienzo = "10:00";
        $reserva1->hora_fin = "12:00";


        $reserva1->save();

        
        $reserva2 = new Reserva();

        $reserva2->user = "2";
        $reserva2->dia = "12";
        $reserva2->mes = "6";
        $reserva2->hora_comienzo = "10:00";
        $reserva2->hora_fin = "12:00";


        $reserva2->save();
    }
}
