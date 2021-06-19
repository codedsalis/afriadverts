@extends('layouts.app-advertiser')

@section('title', 'Advert info and statistics')

@section('content')
    <div class="container mx-auto">

        @if ($adinfo->approved > 0 && !$info)
            <ad-statistics :user="{{ Auth::user() }}" :advert="{{ $adinfo }}"></ad-statistics>
        @else
            <header class="text-3xl md:text-4xl p-3 font-bold text-aa-dark">
                Advert info
            </header>
            @if ($adinfo->approved < 1)
                <div class="flex justify-between p-3">
                    <div>
                    </div>
                    <div class="bg-light-200 border border-light-700 text-light-800 rounded-lg font-medium px-5 py-3">
                        <i class="fa fa-info-circle"></i> You can edit your advert setup now that it has not been approved,
                        it becomes uneditable once
                        approved
                    </div>
                </div>
            @endif
            <ad-info :user="{{ Auth::user() }}" :advert="{{ $adinfo }}"></ad-info>
        @endif
    </div>

@endsection
