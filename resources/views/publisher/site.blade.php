@extends('layouts.app-publisher')

@section('title', 'Site')

@section('content')
    <div class="container mx-auto">
        @if (session('error'))
            <div class="flex justify-center">
                <div class="bg-red-00 text-white px-5 py-4 rounded-lg shadow-md w-auto md:w-1/2 ">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <site v-bind:user="{{ Auth::user() }}" v-bind:site-id="{{ $siteId }}"></site>
    </div>
@endsection
