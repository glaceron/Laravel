<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reserva::where("user", ">", "0")->orderBy("mes","asc")->orderBy("dia", "asc")->orderBy("hora_comienzo" , "asc")->get();
        return view('reservas.index', compact("reservas"));
    }

    public function show($id)
    {
        $reservas = Reserva::find($id);



        return view('reservas.show' , compact("reservas"));
    }

    public function new($dia,$mes)
    {
        $day = $dia;
        $month = $mes;
        $reservas = Reserva::where("dia",$dia)->where("mes",$mes)->get();
        
        return view('reservas.new', compact("day","month","reservas"));
    }

    public function todas($dia,$mes)
    {
        $day = $dia;
        $month = $mes;
        $reservas = Reserva::where("dia",$dia)->where("mes",$mes)->get();
        
        return view('reservas.todas', compact("day","month","reservas"));
    }

    public function store(Request $request)
    {

        $todasReservas = Reserva::where("dia", $request->dia)->where("mes",$request->mes)
        ->get();
        foreach($todasReservas as $todaReserva)
        {
            if(($todaReserva->hora_comienzo) == ($request->hora_comienzo))
            {
                return view("reservas.error");
            }
        }
        $reserva = new reserva();

        $reserva->user = $request->usuario;
        $reserva->dia = $request->dia;
        $reserva->mes = $request->mes;
        $reserva->hora_comienzo = $request->hora;
        if($request-> cantidad == 1)
        {
            $horaMas = substr($request->hora, 0,-3);

            (int)$horaMas = (int)$horaMas +1;

            $reserva->hora_fin =  $horaMas.=":00" ;
        }
        else if($request->cantidad == 2)
        {
            $horaMas = substr($request->hora, 0,-3);

            (int)$horaMas = (int)$horaMas +2;

            $reserva->hora_fin = $horaMas.=":00";
        }

        $reserva->save();
        return redirect()->route("reservas.show" , $reserva);
        
    }

    public function edit($id,$dia,$mes)
    {
        $reserva = Reserva::find($id);

        $day = $dia;
        $month = $mes;
        $reservas = Reserva::where("dia",$dia)->where("mes",$mes)->get();
        $identi =$id;

        return view("reservas.edit", compact("day","month","reservas","identi"));
    }

    public function update(Request $request,$identi)
    {

        $reserva = Reserva::find($identi);
        $reserva->user = $request->usuario;
        $reserva->dia = $request->dia;
        $reserva->mes = $request->mes;
        $reserva->hora_comienzo = $request->hora;
        if($request-> cantidad == 1)
        {
            $horaMas = substr($request->hora, 0,-3);

            (int)$horaMas = (int)$horaMas +1;

            $reserva->hora_fin =  $horaMas.=":00" ;
        }
        else if($request->cantidad == 2)
        {
            $horaMas = substr($request->hora, 0,-3);

            (int)$horaMas = (int)$horaMas +2;

            $reserva->hora_fin = $horaMas.=":00";
        }
        $reserva->save();
        return redirect()->route("reservas.show" , $reserva);
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route("reservas");
    }
}
