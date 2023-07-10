<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateDataEvent = $request->validate([
            'tema_acara' => 'required',
            'lokasi_acara' => 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);


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
     * Display the specified resource.
     */
    public function show(Acara $acara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acara $acara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id_edit_event;

        $validateNewDataEvent = $request->validate([
            'tema_acara' => 'required',
            'lokasi_acara' => 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);

        $validateNewDataEvent =
            [
                'penyelenggara' => $request->penyelenggara,
                'tema_acara' => $request->tema_acara,
                'lokasi_acara' => $request->lokasi_acara,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_berakhir' => $request->waktu_berakhir,
                'keterangan' => $request->keterangan
            ];

        $newData = Acara::where('id', $id)
            ->update($validateNewDataEvent);

        return redirect('/event')->with('success', 'Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acara $event)
    {
        $event->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function rangeEvent($data)
    {
        $start = substr($data, 0, 10);
        $end = substr($data, 13, 24);

        $dataEvent = Acara::whereBetween('waktu_mulai', [$start, $end])->get();
        $countDataEvent = Acara::whereBetween('waktu_mulai', [$start, $end])->count();

        $responseData = [
            'count' => $countDataEvent,
            'data' => $dataEvent
        ];

        return response()->json($responseData);
    }
}
