<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("reservas", function(Blueprint $table)
        {
            $table ->id();
            $table ->timestamps();
            $table ->string("user");
            $table ->integer("dia");
            $table ->integer("mes");
            $table ->string("hora_comienzo"); 
            $table ->string("hora_fin");

        }
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("reservas");
    }
}
