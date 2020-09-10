@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container mx-auto">
        {{-- @if (session('error'))
            <div class="flex justify-center">
                <div class="bg-red-600 text-white px-5 py-4 rounded-lg shadow-md w-auto md:w-1/2 ">
                    {{ session('error') }}
                </div>
            </div>
        @endif --}}

        <user-settings v-bind:user="{{ Auth::user() }}"></user-settings>
    </div>
@endsection
