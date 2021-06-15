@extends('layouts.plantilla')

@section('title', "Reservas")

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tus reservas') }}
        </h2>
    </x-slot>
    <div class="flex flex-col mx-auto container pt-10">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Hora de inicio
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Hora de fin
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Ver</span>
                      </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($reservas as $reserva)
                @if (auth()->user()->id == $reserva->user)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{auth()->user()->name}}</div>
                      </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{$reserva->dia}}/{{$reserva->mes}}/2021</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        {{$reserva->hora_comienzo}}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-700">
                        {{$reserva->hora_fin}}
                      </span>
                    </td>
                    <td class="pr-20 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="{{route("reservas.show" , $reserva->id)}}" class="text-white hover:text-indigo-900 bg-indigo-400 px-4 py-1 rounded-md focus:ring-2 focus:ring-offset-gray-500 focus:outline-none">Ver</a>
                    </td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</x-app-layout>

@endsection


