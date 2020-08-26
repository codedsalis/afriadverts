@extends('layouts.app-publisher')

@section('title', 'Site')

@section('content')
    <div class="container mx-auto">
        <site v-bind:user={{ Auth::user() }} v-bind:site-id={{ $siteId }}></site>
    </div>
@endsection
