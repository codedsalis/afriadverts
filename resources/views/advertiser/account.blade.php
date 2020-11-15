@extends('layouts.app-advertiser')

@section('title', 'My account')

@section('content')

    <div class="container mx-auto">
        <header class="text-3xl md:text-4xl p-3 font-bold text-aa-dark">
            Add Funds
        </header>
        <br />
        <div class="container p-5 w-full text-aa-dark">
            <div class="flex flex-col md:flex-row justify-between">
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div>
                            Please select the currency you want to pay in<br />
                            <select id="currency" onchange="validateAddFundInputAmount()"
                                class="p-3 border-2 w-full border-gray-300 bg-white rounded-md focus:outline-none focus:border-link-100"
                                required>
                                <option value="NGN" selected>Naira - NGN</option>
                                <option value="USD">US Dollar - USD</option>
                            </select>
                        </div>
                        <div>
                            Please select a payment method<br />
                            <div class="py-1">
                                <input type="radio" name="method" value="online" id="online" checked /><label
                                    for="online">&#160;&#160;<i class="fa fa-credit-card"></i>&#160; Online
                                    payment</label>
                            </div>
                            <div class="py-1">
                                <input type="radio" name="method" value="deposit" id="deposit" /><label
                                    for="deposit">&#160;&#160;<i class="fa fa-money"></i>&#160; Bank
                                    transfer/deposit</label>
                            </div>
                        </div>
                    </div>
                    {{-- <form id="paymentForm"> --}}
                        <div class="py-2">
                            <br />
                            <input type="hidden" id="email" value="{{ Auth::user()->email }}" />
                            <input type="hidden" id="first_name" value="{{ Auth::user()->first_name }}" />
                            <input type="hidden" id="last_name" value="{{ Auth::user()->last_name }}" />

                            <label for="amount" class="text-aa-dark">Amount (<span id="currencyLabel">NGN</span>)</label>
                            <input type="number" inputmode="numeric" id="amount" oninput="validateAddFundInputAmount()"
                                placeholder="Enter amount to fund account"
                                class="p-3 border-2 w-full border-gray-300 bg-white rounded-md focus:outline-none focus:border-link-100"
                                required />
                            <span id="inputInfo" class="text-aa-dark">Minimum deposit amount in Nigerian Naira is
                                &#8358;500</span>
                        </div>
                        <button type="button" id="payFunds"
                            onclick="payFunds({{ $Afriadverts->getMoney(env('MINIMUM_DEPOSIT'), Auth::user()->currency) }}, {{ Auth::user()->id }})"
                            class="bg-aa-light text-white font-bold float-right px-10 py-3 rounded-md hover:bg-light-700 focus:outline-none">
                            Pay Now
                        </button>
                        {{--
                    </form> --}}
                </div>
                <div class="p-10 font-bold">
                    <img id="paymentImage" src="{{ env('STATIC_ASSETS') }}/ps.png" alt="PayStack" />
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://js.paystack.co/v1/inline.js"></script>
@endsection
