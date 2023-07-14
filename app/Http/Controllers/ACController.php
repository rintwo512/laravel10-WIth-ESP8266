<?php

namespace App\Http\Controllers;

use App\Models\AC;
use App\Models\ChartAC;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\DataACExportExcel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'wing' => 'required',
            'lantai' => 'required',
            'ruangan' => 'required|min:2',
            'merk' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'kapasitas' => 'required',
            'refrigerant' => 'required',
            'voltage' => 'required|min:3',
            'status' => 'required'
        ]);

        $validator->sometimes('seri_indoor', 'unique:ac,NULL', function ($input) {
            return $input->seri_indoor !== null;
        });

        $validator->sometimes('seri_outdoor', 'unique:ac,NULL', function ($input) {
            return $input->seri_outdoor !== null;
        });

        if ($request->label != NULL) {
            $validator->sometimes('label', 'unique:ac,NULL', function ($input) {
                return !empty($input->label);
            });
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambah data!');
        }
        $petugas_maint = implode(',', $request->petugas_maint);

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
                'petugas_maint' => $petugas_maint,
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
    public function show($id)
    {
        $ac = AC::find($id);

        if (!$ac) {
            return back()->with('error', 'Data AC tidak ditemukan.');
        }

        return view('dataAC.update', [
            'title' => 'Update Data AC',
            'ac' => $ac,
            'dataall' => ['Rinto Harahap', 'Rahmat Abdullah', 'Alim Darmawan', 'Rahmat Hidayatullah', 'Rahmat Haryadi', 'Andriadi Hamid', 'Arif Nur', 'Arif Dg Awing', 'Syahril Dahlan', 'Hasrul']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function dataDetailAcBaru($id)
    {
        $data = AC::find($id);
        return view('dataAC.detailacbaru', [
            'title' => 'Data Detail AC Baru',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $old = AC::find($id);


        $validator = Validator::make($request->all(), [
            'wing' => 'required',
            'lantai' => 'required',
            'ruangan' => 'required|min:3',
            'merk' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'kapasitas' => 'required',
            'refrigerant' => 'required',
            'voltage' => 'required|min:3',
            'status' => 'required'
        ]);

        if ($old->seri_indoor != $request->seri_indoor) {
            $validator->sometimes('seri_indoor', 'unique:ac,NULL', function ($input) {
                return !empty($input->seri_indoor);
            });
        }
        if ($old->seri_outdoor != $request->seri_outdoor) {
            $validator->sometimes('seri_outdoor', 'unique:ac,NULL', function ($input) {
                return !empty($input->seri_outdoor);
            });
        }
        if ($old->label != $request->label) {
            $validator->sometimes('label', 'unique:ac,NULL', function ($input) {
                return !empty($input->label);
            });
        }



        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal mengubah data!');
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

        $petugas_maint = '';

        if ($request->petugas_maint !== null) {
            $petugas_maint = implode(',', $request->petugas_maint);
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
                'petugas_maint' => $petugas_maint,
                'seri_indoor' => $request->seri_indoor,
                'seri_outdoor' => $request->seri_outdoor,
                'user_updated' => auth()->user()->name,
                'user_updated_time' => date('Y-m-d H:i:s')
            ];

        AC::where('id', $id)
            ->update($validateNewData);

        return redirect('/ac')->with('success', 'Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            AC::where('id', $id)->update(['is_delete' => auth()->user()->name]);
            AC::destroy($id);
            return redirect('/ac')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/ac')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
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

        return response()->json(['success' => 'Data berhasil direstore']);
    }

    public function queryRangeAc($nilai)
    {
        $start = substr($nilai, 0, 10);
        $end = substr($nilai, 13, 24);

        $range = AC::whereBetween('user_updated_time', [$start, $end])->get();
        $countRange = $range->count();

        if ($countRange === 0) {
            return response()->json([
                'count' => 0,
                'message' => 'Data tidak ditemukan!'
            ], 404); // Mengirim status HTTP 404 jika data tidak ditemukan
        }

        $responseData = [
            'count' => $countRange,
            'data' => $range
        ];

        return response()->json($responseData);
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

    public function queryDataAcBaru($data)
    {
        $start = substr($data, 0, 10);
        $end = substr($data, 13, 24);

        $dataACBaru = AC::whereBetween('tgl_pemasangan', [$start, $end])->get();
        $countDataACBaru = $dataACBaru->count();

        if ($countDataACBaru === 0) {
            return response()->json([
                'count' => 0,
                'message' => 'Data tidak ditemukan!'
            ], 404); // Mengirim status HTTP 404 jika data tidak ditemukan
        }

        $responseData = [
            'count' => $countDataACBaru,
            'data' => $dataACBaru
        ];

        return response()->json($responseData);
    }
}
