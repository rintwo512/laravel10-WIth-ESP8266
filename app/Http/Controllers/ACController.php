<?php

namespace App\Http\Controllers;

use App\Models\AC;
use App\Models\ChartAC;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\DataACExportExcel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ACController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('dataAC.index', [
            'title' => 'Data AC',
            'data' => AC::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dataAC/create', [
            'title' => 'Tambah Data AC'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateDataAc = $request->validate([
            'wing' => 'required',

            'lantai' => 'required',
            'ruangan' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'ruangan' => 'required',
            'kapasitas' => 'required',
            'refrigerant' => 'required',
            'voltage' => 'required',
            'status' => 'required'
        ]);

        $rulesSeri = [
            'seri_indoor' => 'unique:ac,NULL',
            'seri_outdoor' => 'unique:ac,NULL'
        ];

        if ($request->seri_indoor != NULL) {

            $validateDataAc = $request->validate($rulesSeri);
        }

        $rulesLabel = [
            'label' => 'unique:ac',
        ];
        if ($request->label != NULL) {
            $validateDataAc = $request->validate($rulesLabel);
        }

        $validateDataAc =
            [
                'label' => $request->label,
                'assets' => $request->assets,
                'wing' => $request->wing,
                'lantai' => $request->lantai,
                'ruangan' => $request->ruangan,
                'merk' => $request->merk,
                'type' => $request->type,
                'jenis' => $request->jenis,
                'kapasitas' => $request->kapasitas,
                'refrigerant' => $request->refrigerant,
                'product' => $request->product,
                'current' => $request->current,
                'voltage' => $request->voltage,
                'btu' => $request->btu,
                'pipa' => $request->pipa,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'kerusakan' => $request->kerusakan,
                'keterangan' => $request->keterangan,
                'tgl_pemasangan' => $request->tgl_pemasangan,
                'petugas_pemasangan' => $request->petugas_pemasangan,
                'tgl_maintenance' => $request->tgl_maintenance,
                'petugas_maint' => $request->petugas_maint,
                'seri_indoor' => $request->seri_indoor,
                'seri_outdoor' => $request->seri_outdoor,
                'user_id' => auth()->user()->id
            ];

        AC::create($validateDataAc);
        return redirect('/ac')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AC $aC, $id)
    {
        return view('dataAC.update', [
            'title' => 'Update Data AC',
            'ac' => AC::find($id),
            'dataall' => AC::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AC $aC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AC $aC, $id)
    {
        $old = AC::find($id);

        $rules = [
            'wing' => 'required',
            'lantai' => 'required',
            'ruangan' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'kapasitas' => 'required',
            'refrigerant' => 'required',
            'voltage' => 'required',
            'status' => 'required'
        ];

        $validateNewData = $request->validate($rules);

        $ruleSeri = [
            'seri_indoor' => 'required|unique:ac',
            'seri_outdoor' => 'required|unique:ac'
        ];

        if ($request->seri_indoor != $old->seri_indoor) {
            $validateNewData = $request->validate($ruleSeri);
        }
        if ($request->seri_outdoor != $old->seri_outdoor) {
            $validateNewData = $request->validate($ruleSeri);
        }

        if ($request->tgl_maintenance != $old->tgl_maintenance) {
            $iniBulan = Carbon::now()->format("F");
            $tahunIni = Carbon::now()->format("Y");

            $chartAc = ChartAC::where('bulan', $iniBulan)
                              ->where('tahun', $tahunIni)
                              ->first();

            if ($chartAc) {
                $chartAc->total++;
                $chartAc->save();
            } else {
                ChartAC::create([
                    'tahun' => $tahunIni,
                    'bulan' => $iniBulan,
                    'total' => 1,
                ]);
            }
        }





        $validateNewData =
            [
                'label' => $request->label,
                'assets' => $request->assets,
                'wing' => $request->wing,
                'lantai' => $request->lantai,
                'ruangan' => $request->ruangan,
                'merk' => $request->merk,
                'type' => $request->type,
                'jenis' => $request->jenis,
                'kapasitas' => $request->kapasitas,
                'refrigerant' => $request->refrigerant,
                'product' => $request->product,
                'current' => $request->current,
                'voltage' => $request->voltage,
                'btu' => $request->btu,
                'pipa' => $request->pipa,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'kerusakan' => $request->kerusakan,
                'keterangan' => $request->keterangan,
                'tgl_pemasangan' => $request->tgl_pemasangan,
                'petugas_pemasangan' => $request->petugas_pemasangan,
                'tgl_maintenance' => $request->tgl_maintenance,
                'petugas_maint' => $request->petugas_maint,
                'seri_indoor' => $request->seri_indoor,
                'seri_outdoor' => $request->seri_outdoor,
                'user_updated' => auth()->user()->name,
                'user_updated_time' => date('Y-m-d H:i:s')
            ];
        $newData = AC::where('id', $id)
            ->update($validateNewData);

        // if ($newData > 0) {
        //     $dateNow = Carbon::now();
        //     $getDataUpdate = Ac::where('user_updated_time', $dateNow)->first();
        //     $pesan = '*Tanggal Update* ' . '*' . $dateNow . '*' . "\n"
        //         . "*Data AC yang telah diupdate*\n\n" . "Di update oleh : " . $getDataUpdate->user_updated . "\nWing : " . $getDataUpdate->wing . "\nLantai : " . $getDataUpdate->lantai . "\nRuangan : " . $getDataUpdate->ruangan . "\nMerk : " . $getDataUpdate->merk . "\nType : " . $getDataUpdate->type . "\nStatus : " . $getDataUpdate->status . "\nDi maintenance : " . Carbon::parse($getDataUpdate->tgl_maintenance)->diffForHumans() . "\nCatatan : " . $getDataUpdate->catatan;
        //     $pesanEncode = urlencode($pesan);
        //     $response = Http::get('https://api.telegram.org/bot5372613320:AAHJNa6n0C68VZFWIDcRckIWSjP_UCLiGBU/sendMessage?parse_mode=markdown&chat_id=-532291265&text=' . $pesanEncode);
        // }

        return redirect('/ac')->with('success', 'Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AC::where('id', $id)->update(['is_delete' => auth()->user()->name]);
        AC::destroy($id);
        return redirect('/ac');
    }

    public function deleteCheckedAc(Request $request)
    {
        $ids = $request->ids;
        AC::whereIn('id', $ids)->update(['is_delete' => auth()->user()->name]);
        AC::whereIn('id', $ids)->delete();
        return response()->json(['success' => 'Data have been delete!']);
    }

    public function trash()
    {
        return view('dataAC.trash', [
            'title' => 'Trash',
            'softData' => AC::onlyTrashed()->get()
        ]);
    }

    public function deleteAll()
    {
        AC::onlyTrashed()->forceDelete();
        return redirect('/ac/trash');
    }

    public function restore($id)
    {

        $restoreDataId = AC::withTrashed()->find($id);

        if ($restoreDataId && $restoreDataId->trashed()) {
            $restoreDataId->restore();
        }

        return response()->json(['success' => 'Data kembali']);
    }

    public function queryRangeAc($nilai)
    {
        $start = substr($nilai, 0, 10);
        $end = substr($nilai, 13, 24);

        $range = AC::whereBetween('user_updated_time', [$start, $end])->get();
        return response()->json($range);
    }

    public function exportDataAc()
    {
        return Excel::download(new DataACExportExcel, 'data-ac.xlsx');
    }

    public function listMainten()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3)->format('Y-m-d H:i');
        // dd($threeMonthsAgo);

        $dataAC = AC::where(DB::raw("STR_TO_DATE(tgl_maintenance, '%Y-%m-%d %H:%i')"), '<', $threeMonthsAgo)
             ->get();

        return view('dataAC.listMainten', [
            'title' => 'List Maintenance AC',
            'data' => $dataAC
        ]);
    }
}
