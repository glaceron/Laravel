@extends('layouts.plantilla')

@section('title', "Reservas")

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Reserva') }}
        </h2>
    </x-slot>
    <div class="mt-5 md:mt-0 md:col-span-2 px-20 pt-10 container mx-auto">
        <form action="{{route("reservas.update",$identi)}}" method="POST">
          @csrf
          @method("put")
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="dia" class="block text-sm font-medium text-gray-700">Dia</label>
                    <select id="dia" name="dia" onchange="handleChangeDay(event)" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @for ($i = 1; $i < 32; $i++)
                        @if($day == $i)
                        <option selected>{{$i}}</option>
                        @else
                        <option>{{$i}}</option>
                        @endif
                    @endfor 
                    </select></div>
  
                <div class="col-span-6 sm:col-span-3">
                    <label for="mes" class="block text-sm font-medium text-gray-700">Mes</label>
                    <select id="mes" name="mes"  onchange="handleChangeMonth(event)" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @for ($i = 1; $i < 13; $i++)
                        @if($month == $i)
                        <option selected>{{$i}}</option>
                        @else
                        <option>{{$i}}</option>
                        @endif
                    @endfor 
                    </select>
                </div>
                
                
                <div class="col-span-6 sm:col-span-3">
                  <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                  <select name="hora" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @for ($i = 9; $i < 24; $i++)
                            {{$reservado = false}}
                            {{$reservadoDos = false}}
                    
                            @foreach ($reservas as $reserva)
                                @if ($reserva->hora_comienzo == $i)
                                {{$reservado = true}}
                                    @if ($reserva->hora_fin == $i+2)
                                    {{$reservadoDos = true}}
                                    @endif
                                @endif
                            @endforeach
                                @if ($reservado)
                                <option disabled>{{$i}}:00</option>
                                    @if ($reservadoDos == true)
                                    <option disabled>{{$i+1}}:00</option>
                                    {{$i++}}
                                    @endif
                                @else 
                                    <option>{{$i}}:00</option>
                                @endif
                        @endfor    
                  </select>
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad de Horas</label>
                  <select name="cantidad" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option>1</option>
                    <option>2</option> 
                  </select>
                </div>

            
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <select id="id" name="usuario" style="visibility:hidden;">
                <option selected>{{auth()->user()->id}}</option>
               </select>
               <select id="identi" name="idReserva" style="visibility:hidden;">
                <option selected>{{$identi}}</option>
               </select>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Actualizar
              </button>
            </div>
          </div>
        </form>
      </div>
        <script>
            const handleChangeDay=(event)=>{
                const day = event.target.value;
                const month = document.getElementById("mes").value
                const id = document.getElementById("identi").value
                console.log(day, month)
                location.href = "/reservas/" + id + "/" + day +"/" + month +"/edit"
                }
            
                const handleChangeMonth=(event)=>{
                const month = event.target.value;
                const day = document.getElementById("dia").value
                const id = document.getElementById("identi").value
                console.log(day, month)
                location.href = "/reservas/" + id + "/" + day +"/" + month +"/edit"               
                }
        </script>
</x-app-layout>
@endsection