@extends('layouts.app-advertiser')

@section('title', 'My adverts')

@section('content')

    <div class="container mx-auto">
        <div class="flex justify-between">
            <div class="text-2xl md:text-4xl font-bold text-dark-500">My adverts</div>
            <a v-bind:href="'/a/newadvert/'">
                <button
                    class="px-5 py-3 bg-light-500 text-white font-bold rounded-lg hover:bg-light-700 mt-2 shadow-lg focus:outline-none hover:border-aa-light-active">
                    <i class="fa fa-plus"></i> New advert
                </button>
            </a>
        </div>
        <br />
        @if (count($adverts) > 0)
            <div class="container px-4 py-3 md:px-5 w-full bg-white rounded-lg shadow-sm">
                <div class="overflow-x-scroll w-full">
                    <table class="table table-auto border-collapse">
                        <thead class="border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">ID</th>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">Title</th>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                                    Destination/link
                                </th>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                                    Budget
                                </th>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                                    Created
                                </th>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                                    Status
                                </th>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                                    <i class="fa fa-pie-chart"></i>
                                </th>
                                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                                    <i class="fa fa-trash"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adverts as $advert)
                                <tr>
                                    <td class="px-4 py-2 text-black">{{ $advert->id }}</td>
                                    <td class="px-4 py-2 text-black">
                                        <a href="/a/adinfo/{{ $advert->id }}?info=info"
                                            class="text-link-100 hover:text-link-200"
                                            title="{{ $advert->ad_title }}">{{ strlen($advert->ad_title) > 40 ? substr($advert->ad_title, 0, 40) . '...' : $advert->ad_title }}</a>
                                    </td>
                                    <td class="px-4 py-2 text-dark-500" title="{{ $advert->ad_url }}">
                                        {{ strlen($advert->ad_url) > 20 ? substr($advert->ad_url, 0, 20) . '...' : $advert->ad_url }}
                                    </td>
                                    <td class="px-4 py-2 text-black">
                                        {{ $Afriadverts->showMoney($advert->ad_budget, Auth::user()->currency) }}
                                    </td>
                                    <td class="px-4 py-2 text-black">
                                        {{ date('d M, Y', strtotime($advert->created_at)) }}
                                    </td>
                                    <td class="px-4 py-2 text-black">
                                        @if ($advert->ad_status == 'running')
                                            <span class="text-green-600 font-bold px-2">Active</span>
                                        @elseif($advert->ad_status == 'pending approval')
                                            <span class="text-yellow-600 font-bold px-2">Pending
                                                approval</span>
                                        @elseif($advert->ad_status == 'disapproved')
                                            <span class="text-red-700 font-bold px-2">Disapproved</span>
                                        @elseif($advert->ad_status == 'paused')
                                            <span class="text-gray-700 font-bold px-2">Paused</span>
                                        @elseif($advert->ad_status == 'stopped')
                                            <span class="text-red-600 font-bold px-2">Stopped</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-black">
                                        <a href="/a/adinfo/{{ $advert->id }}"
                                            class="text-link-100 hover:text-link-200">Statistics</a>
                                    </td>
                                    <td class="px-4 py-2 text-black">
                                        <delete-advert :user_id="{{ Auth::user()->id }}" :advert_id="{{ $advert->id }}">
                                        </delete-advert>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br />
            {{ $adverts->links() }}
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
                    No adverts found, click on the button above to get started
                </div>
            </div>
        @endif
    </div>

@endsection
