@extends('layouts.app-advertiser')

@section('title', 'Advert setup')

@section('content')
    <div class="container mx-auto">
        @if ($intent)
            <ad-setup :user="{{ Auth::user() }}" :intent="'{{ $intent }}'"></ad-setup>
        @else
            <div class="flex center flex-col justify-center">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <div class="text-center text-gray-500" style="font-size: 50px">¯\_(ツ)_/¯</div>
                <div class="text-center text-2xl text-gray-500">
                    Wrong page, please go back
                </div>
                <br />
                <br />
            </div>
        @endif
    </div>

@endsection
