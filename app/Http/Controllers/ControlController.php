<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\ControlModel;
use Illuminate\Http\Request;


class ControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('enerTrack.control', [
            'title' => 'Control',
            'relay' => $datas['relay'] = ControlModel::select('power')->first(),
            'suhu' => ControlModel::select('suhu')->first()
        ]);
    }



    public function sendStatus($status)
    {

        $ipAddress ='192.168.1.12';


            $url = 'http://' . $ipAddress . '/receive-data';

            $client = new Client();
            $response = $client->post($url, [
                'form_params' => [
                    'data' => $status,
                ],
            ]);



        $model = ControlModel::find(1);
        $model->power = ($status === 'ON') ? true : false;
        $model->save();

        // Kirim balasan dengan nilai yang diperbarui
        return $status;
    }


    // public function bacarelay()
    // {
    //     $datas['relay'] = ControlModel::select('power')->first();

    //     echo $datas['relay']->power;

    // }

    public function updateSuhudown(Request $request)
    {
        $newSuhudown = $request->input('suhudown');





        $model = ControlModel::find(1);
        $model->suhu =  $newSuhudown;
        $model->save();

        return response()->json(['success' => true]);
    }

    public function sendSuhuToMCU()
    {

            $data['suhu'] = ControlModel::select('suhu')->first();
             $suhu = $data['suhu']->suhu;
             $dataSuhu = strval($suhu);


            $ipAddress ='192.168.1.12';

            $url = 'http://' . $ipAddress . '/data-suhu';

            $client = new Client();
            $response = $client->post($url, [
                'form_params' => [
                    'data' => $dataSuhu,
                ],
            ]);
    }



}
