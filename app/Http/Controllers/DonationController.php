<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donation;

class DonationController extends Controller
{
    // index
    public function index()
    {
        return view('donation');
    }

    // store
    public function store(Request $request){
        // get all data
        $data = $request->all();
        $donation = Donation::create($request->all());


        /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        composer require midtrans/midtrans-php

        Alternatively, if you are not using **Composer**, you can download midtrans-php library
        (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require
        the file manually.

        require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $donation->id,
                'gross_amount' => $donation->amount,
            ),
            'customer_details' => array(
                'first_name' => $request->donor_name,
                'email' =>  $request->donor_email,
                'note' => $request->note,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('checkout', compact('snapToken', 'donation'));
    }
}
