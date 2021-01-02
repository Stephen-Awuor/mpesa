<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class MpesaController extends Controller
{
    public function LipaNaMpesaPassword() //Generates base-64 encoded password.
    {
        //timestamp
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        //passkey
        $passKey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919"; // get it from -> https://developer.safaricom.co.ke/test_credentials
        //businessshortcode
        $businessShortCode = 174379; // get it from -> https://developer.safaricom.co.ke/test_credentials
        //generate password
        $mpesaPassword = base64_encode($businessShortCode.$passKey.$timestamp); //by concatinating(joining) the three
        
        return $mpesaPassword;
    }
    public function newAccessToken(){
        $consumer_key = "blKEE6atNdxXsGREaEppvG1OqfaKO6AB"; //from your app in developer portal.
        $consumer_secret = "pVCBHzcPbL4oTDCm";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);//":" is for concatination
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

        $curl = curl_init(); //curl is a php library for making http requests
        curl_setopt($curl, CURLOPT_URL, $url);//  setting a url(the sandbox one)
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type:application/json")); //setting the http header.Mpesa requirers and http header for verification
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //returns response after sending request
        $curl_response = curl_exec($curl); //request being executed.
        $access_token=json_decode($curl_response); //response returned
        curl_close($curl); //closing curl request
       
        return $access_token->access_token;  //if all is successfull, the token is returned.
        
    }
}
