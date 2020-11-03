@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="container mx-auto">
        {{-- @if (session('error'))
            <div class="flex justify-center">
                <div class="bg-red-600 text-white px-5 py-4 rounded-lg shadow-md w-auto md:w-1/2 ">
                    {{ session('error') }}
                </div>
            </div>
        @endif --}}

        <header class="text-2xl md:text-3xl font-bold text-gray-900">
            Notifications
        </header>

        <notifications v-bind:user="{{ Auth::user() }}"></notifications>
    </div>
@endsection
