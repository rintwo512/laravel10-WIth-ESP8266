<?php

namespace App\Http\Controllers;

use App\Models\enerTrackModel;
use Illuminate\Http\Request;

class enerTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function control()
    {

        

        // return view('enerTrack.control', [
        //     'title' => 'Control'
        // ]);
    }

    public function monitor()
    {
        $data = enerTrackModel::all();
        return view('enerTrack.monitor', [
            'title' => 'Monitor',
            'data' => $data
        ]);
    }
    public function test()
    {
        while (true) {
            // Logika untuk memeriksa perubahan di database
            // Jika ada perubahan, kirimkan respons dengan data yang baru
            // Jika tidak ada perubahan, tahan permintaan untuk beberapa waktu (misalnya 5 detik) sebelum mengirimkan respons kosong

            $data['data'] = enerTrackModel::select('suhu', 'kelembapan')->first();

            if (!empty($data)) {
                return response()->json($data);
            }

            // Tahan permintaan untuk beberapa waktu sebelum memeriksa perubahan di database kembali
            usleep(10000000); // Jeda selama 5 detik
        }
    }


    public function update(Request $request)
    {
        enerTrackModel::where('id', '1')->update(
            [
                'suhu' => $request->suhu,
                'kelembapan' => $request->kelembapan
            ]);

            return redirect('/enertrack/monitor');
    }

}
