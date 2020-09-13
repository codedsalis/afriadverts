<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Store updated user info resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function account(Request $request)
    {
        //Validate
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required|numeric',
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'phone_number' => 'string|nullable',
                'address' => 'string|nullable',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 403);
        }

        //Check for the provided user id
        $user = User::findOrFail(strip_tags($request->userId));

        // lets collect data and save
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        // Save
        if ($user->save()) {
            return new UserResource($user);
        }
    }

    /**
     * Update the user password
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request)
    {
        //Validate
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required|numeric',
                'password' => 'required|confirmed|string|max:255',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 403);
        }

        //Check for the provided user id
        $user = User::findOrFail(strip_tags($request->userId));

        // lets collect data and save
        $user->password = Hash::make($request->password);

        // Save
        if ($user->save()) {
            return response()->json([
                "success" => "Password successfully changed",
            ], 200);
        }
    }


    /**
     * Store updated payment info resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        //Validate
        if ($request->payment_method === 'bank') {
            //Validate bank request only
            $validator = Validator::make(
                $request->all(),
                [
                    'payment_method' => 'required|string',
                    'user_id' => 'required|numeric',
                    'bank_name' => 'required|string|max:100',
                    'account_name' => 'required|string|max:200',
                    'account_number' => 'string|max:15',
                ]
            );
        } elseif ($request->payment_method === 'paypal') {
            // If it is paypal, validate only paypal request
            $validator = Validator::make(
                $request->all(),
                [
                    'payment_method' => 'required|string',
                    'user_id' => 'required|numeric',
                    'paypal_email' => 'string|max:200',
                ]
            );
        } else {
            // Otherwise return an error message
            return response()->json([
                "error" => "Unknown request type",
            ], 403);
        }


        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 403);
        }

        //Check for the provided user id
        $user = User::findOrFail(strip_tags($request->user_id));

        //Accepted payment methods
        $acceptedPayment = [
            'bank',
            'paypal',
        ];

        //Check if the $request->payment_method gives a value other than 'bank' and 'paypal'
        if (!in_array($request->payment_method, $acceptedPayment)) {
            return response()->json([
                "error" => [
                    "payment_method" => "The supplied payment method is not recognised"
                ]
            ], 403);
        }


        // lets collect data and save based on the provided payment method
        if ($request->payment_method === 'bank') {
            $user->bank_name = $request->bank_name;
            $user->account_name = $request->account_name;
            $user->account_number = $request->account_number;
        } elseif ($request->payment_method === 'paypal') {
            $user->paypal_email = $request->paypal_email;
        }

        // Save
        if ($user->save()) {
            return new UserResource($user);
        }
    }
}
