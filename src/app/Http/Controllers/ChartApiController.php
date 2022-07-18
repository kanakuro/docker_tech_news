<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartApiController extends Controller
{
    public static function getIndex(){
        $res_ary = self::getAssets();
        if($res_ary['status'] != 0){
            echo $res_ary['message'];
            return;
        }else{
            $charts_flg = true;
            $data = $res_ary['data'];
            $labels = [];
            $amount = [];
            foreach($data as $index => $asset){
                if($asset['amount'] != 0){
                    $jpy = 0;
                    $amount_jpy = round($asset['amount'] * $asset['conversionRate']);
                    array_push($labels, $asset['symbol']);
                    array_push($amount, $amount_jpy);
                }
            }
        }
        return view('index', [
            'login_id' => session('login_id', 'guest'),
            'charts_flg' => $charts_flg,
            'labels' => $labels,
            'amount' => $amount
        ]);

    }

    public static function getAssets(){
        $apiKey = config('chartapi.chart_api_key');
        $secretKey = config('chartapi.chart_api_secret');
    
        $timestamp = time() . '000';
        $method = 'GET';
        $endPoint = config('chartapi.chart_api_endpoint_private');;
        $path = '/v1/account/assets';
    
        $text = $timestamp . $method . $path;
        $sign = hash_hmac('SHA256', $text, $secretKey);
    
        $curl = curl_init($endPoint . $path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "API-KEY:" . $apiKey,
            "API-TIMESTAMP:" . $timestamp,
            "API-SIGN:" . $sign
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);

        $res_ary = json_decode($response, true);
        if($res_ary['status'] != 0){
            array_merge($res_ary,array('message'=>'データが正常に取得できませんでした。'));
        }
        return $res_ary;
    }



}
