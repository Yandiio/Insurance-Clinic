<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Pasien;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $total_pasien = DB::table('pasien')->count();
        $total_tipe_asuransi = DB::table('tipe_asuransi')->count();
        $total_user = DB::table('users')->count();
        $total_klaim = DB::table('klaim_asuransi')->count();


        $persentase_asuransi = DB::table('klaim_asuransi')
                                    ->join('tipe_asuransi', 'klaim_asuransi.id_tipe_asuransi', '=', 'tipe_asuransi.id')
                                    ->orderBy('klaim_asuransi.updated_at', 'desc')
                                    ->groupBy('tipe_asuransi.nama')
                                    ->select('tipe_asuransi.nama as nama', DB::raw('count(klaim_asuransi.id_tipe_asuransi) as jumlah,count(klaim_asuransi.id_tipe_asuransi) * 100 / (select count(*) from klaim_asuransi) as persentasi'))
                                    ->paginate(5);

        $menunggu_permohonan = DB::table('klaim_asuransi')
                                    ->join('pasien', 'pasien.id','=','klaim_asuransi.id_pasien')
                                    ->join('status', 'status.id','=','klaim_asuransi.id_statusklaim')
                                    ->join('users', 'klaim_asuransi.user_id','=','users.id')
                                    ->join('tipe_asuransi', 'klaim_asuransi.id_tipe_asuransi','=','tipe_asuransi.id')
                                    ->orderBy('klaim_asuransi.updated_at', 'desc')
                                    ->select(DB::raw('pasien.nama_lengkap as nama_pasien, status.status as status, users.name as staff, tipe_asuransi.nama as tipe_asuransi'))
                                    ->where('id_statusklaim', '=', '2')
                                    ->get();

        $pasien = Pasien::paginate(5);

        return view('dashboard', compact('total_pasien', 'total_user', 'total_klaim', 'total_tipe_asuransi', 'menunggu_permohonan', 'persentase_asuransi', 'pasien'));
    }

    
    /**
     * Showing response klaim 6 bulan
     * 
     * @return Response
     */
    public function latestLineChart() 
    {
        $latest_line = DB::table('klaim_asuransi')
                    ->orderBy('klaim_asuransi.updated_at', 'asc')
                    ->select(DB::raw('MONTH(updated_at) as month, count((updated_at)) as jumlah'))
                    ->groupBy(DB::raw('MONTH(updated_at)'))
                    ->get();

        
        return response()->json(['data' => $latest_line]);
    } 

    public function reimburseLineChart() 
    {
        $latest_line = DB::table('klaim_asuransi')
                    ->orderBy('klaim_asuransi.updated_at', 'asc')
                    ->select(DB::raw('MONTH(updated_at) as month, count((updated_at)) as jumlah'))
                    ->groupBy(DB::raw('MONTH(updated_at)'))
                    ->where('id_statusklaim', '=', '3')
                    ->get();

        
        return response()->json(['data' => $latest_line]);
    } 
}
