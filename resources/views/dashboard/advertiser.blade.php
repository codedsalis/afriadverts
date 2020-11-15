@extends('layouts.app-advertiser')

@section('title', 'Advertiser dashboard')

@section('content')
    <div class="container mx-auto">
        @if ($adsCount > 0)

            <header class="text-2xl md:text-3xl font-bold text-gray-900">
                Dashboard
            </header>
            <advertiser-dashboard :user="{{ Auth::user() }}"></advertiser-dashboard>
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
                    You currently have no adverts, click on the button below to get started
                </div>
                <br />
                <br />
                <a href="/a/newadvert">
                    <button
                        class="bg-aa-light text-white font-bold rounded-full animation py-3 px-10 hover:scale-105 hover:bg-light-700 focus:outline-none">
                        Start an Advert
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </a>
            </div>
        @endif
    </div>
@endsection
