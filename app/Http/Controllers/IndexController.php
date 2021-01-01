<?php

/*
 *   Created on: Jan 1, 2021   10:31:22 AM
 */

namespace App\Http\Controllers;

use App\Components\JsonRpcClient;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function collect;
use function dump;
use function tableView;
use function view;

class IndexController extends Controller
{

    public function index()
    {
        $response = (new JsonRpcClient())
              ->send('weather.getHistory',
              [
                 'lastDays' => 30
        ]);


        $lastDays = Arr::get($response, 'result.lastDays');


        $tableTemperatureLastNDays = tableView(collect($lastDays))
              ->column('Дата',
                    function($val)
              {
                  return $val['date_at'];
              })
              ->column('Температура',
                    function($val)
              {
                  return $val['temp'];
              })
              ->render();


        return view('welcome',
              [
                 'date' => '',
                 'tableTemperatureLastNDays' => $tableTemperatureLastNDays
        ]);
    }

    public function weatherForDate(Request $request)
    {
        $date = $request->input('date');

        $response = (new JsonRpcClient())
              ->send('weather.getByDate', [
                 'date' => $date
        ]);

        $temperature = Arr::get($response, 'result.temperature');


        return view('welcome',
              [
                 'temperature' => $temperature,
                 'date' => $date
        ]);
    }

}
