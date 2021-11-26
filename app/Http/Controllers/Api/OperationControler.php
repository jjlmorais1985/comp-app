<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationControler extends Controller
{
    public function index() {
        # Get api result
        $url = "http://localhost:3000/api/operations/";

        $curl = curl_init();       
        // $url = sprintf("%s?%s", $url, http_build_query($rib));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($curl);
    
        curl_close($curl);
        
        // $result = json_decode($result);
        return $result;
     }
}