<?php

namespace App\Http\Controllers;

use App\Models\AC;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ChartAC;
use App\Models\HomeModel;
use App\Models\TodoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = TodoModel::all();

        $threeMonthsAgo = Carbon::now()->subMonths(3)->format('Y-m-d H:i');
        // dd($threeMonthsAgo);

        $dataCuciAC = AC::where(DB::raw("STR_TO_DATE(tgl_maintenance, '%Y-%m-%d %H:%i')"), '<', $threeMonthsAgo)
             ->get()->count();

        $kalTahun = DB::table('chartac')->select('tahun')->groupBy('tahun')->orderBy('tahun', 'DESC')->get()->count();

        $kal = intval(ChartAC::sum('total'));


        $countAcRusak = AC::where('status', 'Rusak')->count();

        $list_tahun = DB::table('chartac')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

            return view('home.index', [
                'title' => 'Home',
                'list_tahun' => $list_tahun,
                'countData' => AC::count(),
                'jadwalCuci' => $dataCuciAC,
                'countUsers' => User::count(),
                'kal' => $kal,
                'kalTahun' => $kalTahun,
                'countAcRusak' => $countAcRusak,
                'todos' => $todos
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
