@extends('layouts.app-publisher')

@section('title', 'Add new site')

@section('content')
    <div class="container mx-auto">
        <header class="text-2xl md:text-3xl font-bold text-gray-900">
            New Website
        </header>
        <new-site v-bind:user="{{ Auth::user() }}"></new-site>
    </div>
@endsection
