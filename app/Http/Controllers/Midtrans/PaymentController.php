<?php

namespace App\Http\Controllers\Midtrans;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Midtrans\Config;
use App\Http\Controllers\Midtrans\CoreApi;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function bcaVAPayment(Request $request){
        try{
            $transactionRequest = array(
                "payment_type" => "bank_transfer",
                "transaction_details" => [
                    "gross_amount" => 10000,
                    "order_id" => date('Y-m-dHis')
                ],
                "customer_details" => [
                    "email" => "muchsin.hisyam@gmail.com",
                    "first_name" => "Muchsin",
                    "last_name" => "Hisyam",
                    "phone" => "+6281 1234 1234"
                ],
                "item_details" => array([
                    "id" => "1388998298204",
                    "price" => 5000,
                    "quantity" => 1,
                    "name" => "Ayam 1"
                ],[
                    "id" => "1388998228204",
                    "price" => 5000,
                    "quantity" => 1,
                    "name" => "Ayam 2"
                ]),
                "bank_transfer" => [
                    "bank" => "bca",
                    "va_number" => "111111",
                ]
            );

            // Send the transaction request body to the CoreApi class - charge method
            $charge = CoreApi::charge($transactionRequest);
            if(!$charge){
                return ['code' => 0, 'message' => 'Error occured'];
            }
            return ['code' => 1, 'message' => 'Success', 'result' => $charge];
        } catch (\Exception $e){
            // throw $e;
            dd($e);
            return ['code' => 1, 'message' => 'Success', 'result' => $charge];
        }
    }
}
// "free_text": {
//     "inquiry": [
//           {
//               "id": "Free Text ID Free Text ID Free Text ID",
//               "en": "Free Text EN Free Text EN Free Text EN"
//           }
//     ],
//     "payment": [
//           {
//               "id": "Free Text ID Free Text ID Free Text ID",
//               "en": "Free Text EN Free Text EN Free Text EN"
//           }
//     ]
// },
// "bca": {
//   "sub_company_code": "00000"
// }