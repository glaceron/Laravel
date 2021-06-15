@extends('layouts.plantilla')

@section('title', "Reservas")

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Reserva') }}
        </h2>
    </x-slot>
    <div class="text-white">{{$day = $reservas->dia}}
      {{$month = $reservas->mes}}
      @if ($month<10)
      {{$month = (int)$month}}
  @endif</div>
    <div class="pt-10 mx-auto container max-w-xl">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 text-center">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Información de tu reserva
          </h3>
        </div>
        <div class="border-t border-gray-200">
          <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 text-center">
              <dt class="text-sm font-medium text-gray-500">
                Nombre
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                {{auth()->user()->name}}
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 text-center">
              <dt class="text-sm font-medium text-gray-500">
                Fecha
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 ">
                {{$reservas->dia}}/{{$reservas->mes}}/2021
              </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 text-center">
              <dt class="text-sm font-medium text-gray-500">
                Hora de inicio
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 ">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{$reservas->hora_comienzo}}
                </span>
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 text-center">
              <dt class="text-sm font-medium text-gray-500">
                Hora de fin
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 ">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-700">
                  {{$reservas->hora_fin}}
                </span>
              </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5  sm:gap-16 sm:px-6 text-center flex justify-center">
              <a href="{{route("reservas.edit",[$reservas,$day,$month])}}" class="text-white hover:text-indigo-900 bg-indigo-400 px-4 py-1 rounded-md focus:ring-2 focus:ring-offset-gray-500 focus:outline-none">Editar</a>
              <form action="{{route("reservas.destroy" , $reservas)}}" method="POST">
                @csrf
                @method("delete")
                <button type="submit" class="text-white hover:text-indigo-900 bg-indigo-400 px-4 py-1 rounded-md focus:ring-2 focus:ring-offset-gray-500 focus:outline-none">Eliminar</button>
              </form>
            </div>
          </dl>
        </div>
      </div>
    </div>

</x-app-layout>

@endsection


