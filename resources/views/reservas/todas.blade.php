@extends('layouts.plantilla')

@section('title', "Reservas")

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todas las reservas') }}
        </h2>
    </x-slot>

    <div class="mt-5 md:mt-0 md:col-span-2 px-20 pt-10 mx-auto container">
        <form action="{{route("reservar.store")}}" method="POST">
          @csrf
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
              </div>
            </div>
          </div>
        </form>
      </div>
        <script>
            const handleChangeDay=(event)=>{
                const day = event.target.value;
                const month = document.getElementById("mes").value
                console.log(day, month)
                location.href = "/reservas/" + day +"/" + month
                }
            
                const handleChangeMonth=(event)=>{
                const month = event.target.value;
                const day = document.getElementById("dia").value
                console.log(day, month)
                location.href = "/reservas/" + day +"/" + month                
                }
        </script>


    <div class="flex flex-col mx-auto container pt-10">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Hora de inicio
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Hora de fin
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($reservas as $reserva)
                
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-center text-gray-900">{{$reserva->dia}}/{{$reserva->mes}}/2021</div>
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                      <span class="px-2 inline-flex text-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        {{$reserva->hora_comienzo}}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                      <span class="px-2 inline-flex  text-center text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-700">
                        {{$reserva->hora_fin}}
                      </span>
                    </td>
                  </tr>
                
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</x-app-layout>

@endsection


