@extends('layouts.app')

@section('title', 'Account Dashboard')

@section('content')
    <div class="container mx-auto">
        <header class="text-4xl md:text-5xl font-black text-aa-darker text-center p-2">
            Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </header>
        <p class="text-3xl text-center">
            What would you like to do?
        </p>
        <br />
        <div class="flex justify-around mt-12">
            <div class="flex justify-center w-4/5 md:w-2/4 flex-col sm:flex-col md:flex-row">
                <a href="{{ route('publisher.dashboard') }}">
                    <div
                        class="transition-all duration-500 ease-in-out bg-gray-200 shadow-md rounded-md p-8 hover:bg-aa-light transform hover:text-white hover:-translate-y-1 hover:scale-110 m-1">
                        <b class="font-bold text-base text-center">
                            <i class="fa fa-briefcase"></i> Monitize Your Website
                        </b>
                        <br />
                        As a website owner, place our ad codes on your website to start earning from it today
                    </div>
                </a>
                <a href="{{ route('advertiser.dashboard') }}">
                    <div
                        class="transition duration-500 ease-in-out bg-gray-200 shadow-md rounded-md p-8 hover:bg-aa-dark transform hover:text-white hover:-translate-y-1 hover:scale-110 m-1">
                        <b class="font-bold text-base text-center">
                            <i class="fa fa-bullhorn"></i> Set up an Advert
                        </b>
                        <br />
                        Get your business displayed to thousands of audiences across the world
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
