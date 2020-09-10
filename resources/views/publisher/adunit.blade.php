@extends('layouts.app-publisher')

@section('title', 'Ad Unit')

@section('content')
    <div class="container mx-auto">
        <ad-unit v-bind:user="{{ Auth::user() }}" v-bind:unit-id="{{ $unitId }}"></ad-unit>
    </div>
@endsection
