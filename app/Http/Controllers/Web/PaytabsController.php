<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Paytabs;

class PaytabsController extends Controller
{
    /**
     * Request payment
     *
     * @return response
     */
    public function paymentRequest() {
        $pt = Paytabs::getInstance(env('PAYTABS_MERCHANT_EMAIL'), env('PAYTABS_SECRET_KEY'));
        $result = $pt->create_pay_page(array(
            "merchant_email" => env('PAYTABS_MERCHANT_EMAIL'),
            'secret_key' => env('PAYTABS_SECRET_KEY'),
            'title' => 'INSERT TITLE HERE',
            'cc_first_name' => 'INSERT_YOUR_FIRST_NAME_HERE',
            'cc_last_name' => "INSERT LKAST NAME HERE",
            'email' => 'INSERT_YOUR_EMAIL_HERE',
            'cc_phone_number' => 'INSERT_YOUR_PHONE_HERE',
            'phone_number' => 'INSERT_YOUR_PHONE_HERE',
            'billing_address' => 'INSERT_YOUR_PHONE_HERE',
            'city' => 'INSERT_YOUR_CITY_HERE',
            'state' => 'INSERT_YOUR_STATE_HERE',
            'postal_code' => "INSERT_YOUR_POSTALCODE_HERE",
            'country' => "SAU",
            'address_shipping' => 'INSERT_YOUR_ADDRESS_SHIPPING_HERE',
            'city_shipping' => 'INSERT_YOUR_CITY_SHIPPING_HERE',
            'state_shipping' => 'INSERT_YOUR_STATE_SHIPPING_HERE',
            'postal_code_shipping' => "INSERT_YOUR_POSTAL_CODE_SHIPPING_HERE",
            'country_shipping' => "SAU",
            "products_per_title"=> "COMPANY NAME",
            'currency' => "SAR",
            "unit_price"=> 100,
            'quantity' => "1",
            'other_charges' => "0",
            'amount' => 100,
            'discount'=>"0",
            "msg_lang" => "english",
            "reference_no" => '1',
            "site_url" => "site_url",                                       // INSERT HERE SITE URL
            'return_url' => "127.0.0.1:8000/payment/paytabs/response",      // INSERT HERE RETURN URL RESPONSE
            "cms_with_version" => "API USING PHP"
        ));

        if($result->response_code == 4012){
            return redirect($result->payment_url);
        }
        return $result->result;
    }

    /**
     * Payment response
     *
     * @return response
     */
    public function paymentResponse(Request $request) {
        $pt = Paytabs::getInstance(env('PAYTABS_MERCHANT_EMAIL'), env('PAYTABS_SECRET_KEY'));
        $result = $pt->verify_payment($request->payment_reference);
        if($result->response_code == 100){
            return 'payment done';
        }
        return $result->result;
    }
}
