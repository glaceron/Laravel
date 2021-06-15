<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Reserva;
use App\Http\Resources\Reserva as ReservaResource;
   
class ReservaController extends BaseController
{

    public function index()
    {
        // get all tasks
        // $tasks = Task::all();
        // get user tasks (error)
        // $tasks = auth()->user()->tasks();
        $reservas = Reserva::where('user', auth()->user()->id)->orderBy("mes","asc")->orderBy("dia", "asc")->orderBy("hora_comienzo" , "asc")
               ->get();
        return $this->sendResponse(ReservaResource::collection($reservas), 'Tasks fetched.');
    }

    
    public function store(Request $request)
    {
        $todasReservas = Reserva::where("dia", $request->dia)->where("mes",$request->mes)
        ->get();
        foreach($todasReservas as $todaReserva)
        {
            if(($todaReserva->hora_comienzo) == ($request->hora_comienzo))
            {
                return $this->sendError('Esa hora ya esta ocupada');
            }
            else if((($todaReserva->hora_fin) > ($request->hora_comienzo)&&($todaReserva->hora_fin) <= ($request->hora_fin))||(($todaReserva->hora_comienzo) > ($request->hora_comienzo)&&($todaReserva->hora_comienzo) > ($request->hora_fin)))
            {
                return $this->sendError('Esa hora ya esta ocupada +1');
            }
            else if(($todaReserva->user)==(auth()->user()->id))
            {
                return $this->sendError('Ya tienes una reserva ese dia');
            }
        }
        
        $reservas = new Reserva();
    	$reservas->dia = $request->dia;
        $reservas->mes = $request->mes;
        $reservas->hora_comienzo = $request->hora_comienzo;
        $reservas->hora_fin = $request->hora_fin;
    	$reservas->user = auth()->user()->id;
    	$reservas->save();
        
        return $this->sendResponse(new ReservaResource($reservas), 'Reserva created.');
    }

   
    public function show($id)
    {
        $reservas = Reserva::find($id);
        
        if (is_null($reservas)) {
            return $this->sendError('Reserva does not exist.');
        }
        return $this->sendResponse(new ReservaResource($reservas), 'Reserva fetched.');
    }
    

    public function update(Request $request, Reserva $reservas)
    {
        $input = $request->all();

        $todasReservas = Reserva::where("dia", $request->dia)->where("mes",$request->mes)
        ->get();
        foreach($todasReservas as $todaReserva)
        {
            if(($todaReserva->hora_comienzo) == ($request->hora_comienzo))
            {
                return $this->sendError('Esa hora ya esta ocupada');
            }
            else if((($todaReserva->hora_fin) > ($request->hora_comienzo)&&($todaReserva->hora_fin) <= ($request->hora_fin)))
            {
                return $this->sendError('Esa hora ya esta ocupada +1');
            }
        }
        $reservas = new Reserva();
    	$reservas->dia = $request->dia;
        $reservas->mes = $request->mes;
        $reservas->hora_comienzo = $request->hora_comienzo;
        $reservas->hora_fin = $request->hora_fin;
    	$reservas->user = auth()->user()->id;
    	$reservas->save();
        //$reservas->description = $input['description'];
        //$task->description = $request->description;
        
        return $this->sendResponse(new ReservaResource($reservas), 'Reserva updated.');
    }
   
    public function destroy($id)
    {
		$reservas = Reserva::find($id);
		if (is_null($reservas)) {
			return $this->sendError('Task does not exist.', 'Task NOT deleted.');
		}
		else {
			$reservas->delete();
			return $this->sendResponse([], 'Task deleted.');
		}
    }
}
