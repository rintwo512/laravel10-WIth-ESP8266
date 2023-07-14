<?php

namespace App\Http\Controllers;

use App\Models\ChartAC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class chartACController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        

        $input = $request->updateTahun;
        
        

        $dataTotalUnit = ChartAC::where('tahun', $input)->sum('total');


        $dataTahun = ChartAC::where('tahun', $input)->get();

        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


        $listUpdateTahun = DB::table('chartac')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

            
    
        return view('chartAC.index', [
            'title' => 'Chart AC',
            'listUpdateTahun' => $listUpdateTahun,
            'dataChart' => $dataTahun,
            'month' => $month,
            'dataTotalUnit' => intval($dataTotalUnit)
        ]);
    }

    public function searchChart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'updateTahun' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->with('error', 'Tidak ada data yang dipilih!');
        }

        $input = $request->updateTahun;
        
        

        $dataTotalUnit = ChartAC::where('tahun', $input)->sum('total');


        $dataTahun = ChartAC::where('tahun', $input)->get();

        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


        $listUpdateTahun = DB::table('chartac')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

            
    
        return view('chartAC.index', [
            'title' => 'Chart AC',
            'listUpdateTahun' => $listUpdateTahun,
            'dataChart' => $dataTahun,
            'month' => $month,
            'dataTotalUnit' => intval($dataTotalUnit)
        ]);
    }

    public function tambahDataChart(Request $request)
    {
        $rules = [
            'tahunChart' => 'required',
            'monthChart' => 'required',
            'totalChart' => 'required'
        ];

        $data = $request->validate($rules);
        $data = [
            'tahun' => $request->tahunChart,
            'bulan' => $request->monthChart,
            'total' => $request->totalChart
        ];

        ChartAC::create($data);

        return redirect('/chart/search')->with('success', 'Data has been Added!');
    }

    public function deleteDataChartAc($id)
    {
        ChartAC::where('id', $id)->delete();

        return response()->json(['success' => 'Ok']);
    }

    public function updateDataChart(Request $request)
    {
        $id = $request->idUpdateChart;

        $rules = [
            'tahunUpdateChart' => 'required',
            'monthUpdateChart' => 'required',
            'totalUpdateChart' => 'required'
        ];

        $data = $request->validate($rules);
        $data = [
            'tahun' => $request->tahunUpdateChart,
            'bulan' => $request->monthUpdateChart,
            'total' => $request->totalUpdateChart
        ];

        $setDB = ChartAC::where('id', $id)->update($data);


        return redirect('/chart/search')->with('success', 'Data has been updated!');
    }

    public function deleteAllChart(Request $request)
    {
        $tahun = $request->deleteAllChart;
        
        if($tahun == null){
            return back()->with('error', 'Tidak ada data yang dipilih!');
        }else{
            ChartAC::where('tahun', $tahun)->delete();
            return back()->with('success', 'Data tahun ' . $tahun . ' berhasil dihapus!');
        }
    }
}
