@extends('layouts.app-advertiser')

@section('title', 'Select advert objective')


@section('content')
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-aa-dark">
            Advert objective
        </h2>
        <p class="text-2xl text-aa-dark font-medium">
            What aim are you trying to achieve with this advert?
        </p>
        <br />
        <div class="flex flex-col justify-center">
            <a href="/a/adsetup?intent=website">
                <button
                    class="bg-white text-aa-dark p-4 text-left rounded md:w-4/5 w-full hover:bg-gray-300 focus:outline-none border-b border-gray-200">
                    <i class="fa fa-globe"></i>
                    &#160;&#160; Drive traffic to your website
                    <i class="fa fa-angle-right fa-2x float-right"></i>
                </button>
            </a>
            <a href="/a/adsetup?intent=whatsapp">
                <button
                    class="bg-white text-aa-dark p-4 text-left rounded md:w-4/5 w-full hover:bg-gray-300 focus:outline-none border-b border-gray-200">
                    <i class="fa fa-envelope"></i>
                    &#160;&#160; Get Whatsapp message(s)
                    <i class="fa fa-angle-right fa-2x float-right"></i>
                </button>
            </a>
            <a href="/a/adsetup?intent=phone">
                <button
                    class="bg-white text-aa-dark p-4 text-left rounded md:w-4/5 w-full hover:bg-gray-300 focus:outline-none border-b border-gray-200">
                    <i class="fa fa-phone"></i>
                    &#160;&#160; Get Phone call(s)
                    <i class="fa fa-angle-right fa-2x float-right"></i>
                </button>
            </a>
        </div>
    </div>
@endsection
