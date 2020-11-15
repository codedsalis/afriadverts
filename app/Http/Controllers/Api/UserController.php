<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\AccountFunding;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\AccountFundingResource;
use App\Library\Afriadverts;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function savePaymentRecords(Request $request) {
        // Validate
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required',
            'payment_method' => [
                'required',
                Rule::in(['deposit', 'online']),
            ],
            'reference' => 'required',
            'currency' => [
                'required',
                Rule::in(['NGN', 'USD']),
            ],
        ]);

        if($validator->fails()) {
            return \response()->json([
                $validator->errors()
            ], 403);
        }


        $accountFunding = new AccountFunding;
        $user = User::findOrFail($request->user_id);

        // Convert the money from either naira or USD 
        // to Kobo before saving to the Database
        $currency = $request->currency;
        $amountToStore = Afriadverts::moneyToKobo($request->amount, $currency);

        $accountFunding->user_id = $request->user_id;
        $accountFunding->amount = $amountToStore;
        $accountFunding->payment_method = $request->payment_method;
        $accountFunding->reference = $request->reference;
        $accountFunding->currency = $request->currency;


        //Update the user advertising balance
        $previousBalance = $user->advertiser_balance;
        $newBalance = $previousBalance+$amountToStore;

        if(
            $accountFunding->save() && User::where('id', $request->user_id)
                                            ->update(['advertiser_balance' => $newBalance])
        ) {
            return new AccountFundingResource($accountFunding);
        }

    }
}
