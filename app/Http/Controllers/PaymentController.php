<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    function index(Request $request) {
        if($request['nonce'] != null){

            $sponsorType = Sponsor::where('id', $request['sponsor_id'])->first();
            $duration = explode(':', $sponsorType->duration);

            $apartment = Apartment::where('id', '=', $request['apartment_id'])->first();

            $gateway = $this->brainConfig();
            $nonceFromTheClient = $request['nonce'];
        
            $transaction = $gateway->transaction()->sale([
                'amount' => $sponsorType->price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            if($transaction->success) {
                
                $actualDate = date("Y-m-d H:i:s");

                $sponsorship = DB::table('apartment_sponsor')
                    ->where('apartment_id', $apartment->id)
                    ->where('expiry_date', '>=', $actualDate)
                    ->get()->last();

                if (isset($sponsorship)) {
                    $date = $sponsorship->expiry_date;
                } else {
                    $date = $actualDate;
                    return response()->json([
                        'success' => true
                    ]);
                }

                $endDate = date("Y-m-d H:i:s", strtotime($date . '+' . $duration[0] . 'hours +' . $duration[1] . 'minutes +' . $duration[2] . 'seconds'));

                $apartment->sponsors()->attach(
                    $apartment->id,
                    [
                        'sponsor_id' => $request['sponsor_id'],
                        'expiry_date' => $endDate,
                    ]
                );

                // return to_route('apartments.show', compact('apartment'))
                //     ->with('message', 'Your apartment is sponsored until the date: ' . date('d-m-Y', strtotime($endDate)) . ' at ' . date('H:i', strtotime($endDate)));
                return response()->json([
                    'success' => true
                ]);
            }
        }
    }

    function token(){
        $gateway = $this->brainConfig();
        return $clientToken = $gateway->clientToken()->generate();
    }

    function brainConfig() {
        return new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
    }
}
