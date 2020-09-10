@extends('layouts.app-publisher')

@section('title', 'New Ad unit')

@section('content')
    <div class="container mx-auto">
        <header class="text-2xl md:text-3xl font-bold text-gray-900">
            Create ad unit
        </header>
        <new-adunit v-bind:user="{{ Auth::user() }}" v-bind:site-id="{{ $siteId }}"></new-adunit>
    </div>
@endsection
