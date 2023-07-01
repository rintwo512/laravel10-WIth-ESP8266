<?php

namespace App\Http\Controllers;

use App\Models\ChartAC;
use App\Models\HomeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_tahun = DB::table('chartac')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

            return view('home.index', [
                'title' => 'Home',
                'list_tahun' => $list_tahun
            ]);
    }

    public function getChart(Request $request)
    {
        $tahun = $request->tahun;
        $data = ChartAC::where('tahun', $tahun)
            ->orderBy('tahun', 'ASC')
            ->get()->toArray();
        foreach ($data as $d) {
            $output[] = array(
                'tahun' => $d['tahun'],
                'bulan' => $d['bulan'],
                'total' => $d['total']
            );
        }
        echo json_encode($output);
    }


}
