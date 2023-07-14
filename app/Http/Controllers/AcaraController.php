<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('acara.index', [
            'title' => 'Daftar Event',
            'data' => Acara::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'tema_acara' => 'required|min:3',
            'lokasi_acara' => 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);

        $validator->sometimes('penyelenggara', 'min:2', function ($input) {
            return $input->keterangan !== null;
        });

        $validator->sometimes('keterangan', 'min:3', function ($input) {
            return $input->keterangan !== null;
        });

        if ($validator->fails()) {
            return redirect('/event')
                ->withErrors($validator)
                ->withInput();
        }


        $validateDataEvent =
            [
                'penyelenggara' => $request->penyelenggara,
                'tema_acara' => $request->tema_acara,
                'lokasi_acara' => $request->lokasi_acara,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_berakhir' => $request->waktu_berakhir,
                'keterangan' => $request->keterangan
            ];

        Acara::create($validateDataEvent);
        return redirect('/event')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $id = $request->id_edit_event;
        $data = Acara::find($id);

        $validator = Validator::make($request->all(), [
            'tema_acara' => 'required|min:3',
            'lokasi_acara' => 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);

        if ($data->penyelenggara != $request->penyelenggara) {
            $validator->sometimes('penyelenggara', 'min:2', function ($input) {
                return !empty($input->penyelenggara);
            });
        }

        if ($data->keterangan != $request->keterangan) {
            $validator->sometimes('keterangan', 'min:3', function ($input) {
                return !empty($input->keterangan);
            });
        }

        if ($validator->fails()) {
            return redirect('/event')
                ->withErrors($validator)
                ->withInput();
        }

        $validateNewDataEvent = [
            'penyelenggara' => $request->penyelenggara,
            'tema_acara' => $request->tema_acara,
            'lokasi_acara' => $request->lokasi_acara,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir,
            'keterangan' => $request->keterangan
        ];

        $affectedRows = Acara::where('id', $id)
            ->update($validateNewDataEvent);

        if ($affectedRows > 0) {
            return redirect('/event')->with('success', 'Data berhasil diubah!');
        } else {
            return redirect('/event')->with('error', 'Gagal mengubah data!');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acara $event)
    {
        $event->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function rangeEvent($dataInput)
    {
        $start = substr($dataInput, 0, 10);
        $end = substr($dataInput, 13, 24);

        $dataEvent = Acara::whereBetween('waktu_mulai', [$start, $end])->get();
        $countDataEvent = $dataEvent->count();

        if ($countDataEvent === 0) {
            return response()->json([
                'count' => 0,
                'message' => 'Data not found'
            ], 404); // Mengirim status HTTP 404 jika data tidak ditemukan
        }

        $responseData = [
            'count' => $countDataEvent,
            'data' => $dataEvent
        ];

        return response()->json($responseData);
    }
}
