@extends('layouts.app-publisher')

@section('title', 'My sites')

@section('content')
    <div class="container mx-auto">
        <user-sites v-bind:user="{{ Auth::user() }}"></user-sites>
    </div>
@endsection
