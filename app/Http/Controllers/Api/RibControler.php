<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RibResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class RibControler extends Controller
{
    public function index(Request $request) {
        # Get api result
        // echo $request;
        $operationsTable = array();
        $rib = $request->rib;
        $begin = $request->begin;
        $end = $request->end;      

        /* Send request to external api */

        $url = "http://localhost:3000/api/operations/".$rib;
        $curl = curl_init();       
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result);

        // var_dump($result);
        
        # filter results by date
        foreach ($result as $res){
            $opDate = $res->date;
            if ($begin <= $opDate && $opDate <= $end) {
                // var_dump($res);
                array_push($operationsTable, $res);
            }
        }

        $result = $operationsTable;

        // Return call RibResource to add new fiels and returns it;
        return RibResource::collection($result);
    }

}
