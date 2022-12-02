<?php

namespace App\Http\Controllers\weather;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\requestModel;
use App\Models\Models\answerModel;
use App\Models\Models\fullModel;

class weatherController extends Controller
{
    public function request() {
        return response()->json(requestModel::get(), 200);
    }
    public function requestSave(Request $req)
    {
        requestModel::create($req->all());
        
        $lat = requestModel::orderBy('id','desc')->value('lat');
        $lon = requestModel::orderBy('id','desc')->value('lon');

        $url = 'https://api.openweathermap.org/data/2.5/weather';

        $options = array(
        'lat' => $lat,
        'lon' => $lon,
        'units'=> 'metric',
        'appid' => '9d34442046bee6a0a310742cda043ea6' ,   );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT , 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION  , true);
        curl_setopt($ch, CURLOPT_MAXREDIRS  , 10);
        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($options));
            
       $response = curl_exec($ch);
       $err = curl_error($ch);
       curl_close($ch);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
        }
        
      $dtint = $data   ['dt'];
      $city = $data    ['name'];
      $country = $data ['sys']['country'];
      $weather = $data ['weather'][0]['main'];
      $temp = $data    ['main']['temp'];
      $pressure = $data['main']['pressure'];
      $humidity = $data['main']['humidity'];
      answerModel::create(["dt"=>$dtint,"city"=>$city,"country"=>$country,"weather"=>$weather,"temp"=>$temp,"pressure"=>$pressure,"humidity"=>$humidity]); 

        date_default_timezone_set('Europe/Moscow');
        $datetimeFormat = 'Y-m-d H:m:s';    
        $dt = new \DateTime();
        $dt->setTimestamp($dtint)->format($datetimeFormat);  
                  
      fullModel::create(["lat"=>$lat,"lon"=>$lon,"dt"=>$dt,"city"=>$city,"country"=>$country,"weather"=>$weather,"temp"=>$temp,"pressure"=>$pressure,"humidity"=>$humidity]); 

      return response()->json($data, 201);
       
    }
    public function answer() {
        return response()->json(answerModel::get(), 200);
    }
    public function full() {
        return response()->json(fullModel::get(), 200);
    }
 }
