<?php

/*
 *   Created on: Jan 1, 2021   10:31:22 AM
 */

namespace App\Http\Controllers;

use App\Components\JsonRpcClient;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {
        return view('welcome',
              [
                 'date'=> ''
              ]);
    }

    public function weatherForDate(Request $request)
    {
        $date = $request->input('date');

        $response = (new JsonRpcClient())
              ->send('weather.getByDate', [
                 'date' => $date
        ]);


        $temperature = collect($response)->get('result');

        return view('welcome',
              [
                 'temperature' => $temperature,
                 'date' => $date
        ]);
    }

}
