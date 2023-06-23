<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KlaimAsuransi;
use App\Models\TipeAsuransi;
use App\Exports\ReimburseExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\ExcelServiceProvider;
use DB;
use App\Models\Pasien;
use Carbon\Carbon;



class ReimburseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reimburse = KlaimAsuransi::whereNot('id_statusklaim','1')->paginate(10);
        $tipe_asuransi = TipeAsuransi::get();
        
        return view('pages.reimburse.index', ['reimburse' => $reimburse, 'tipe_asuransi' => $tipe_asuransi]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) 
    {
        $reimburse = DB::table('klaim_asuransi')
                        ->join('status', 'klaim_asuransi.id_statusklaim', '=', 'status.id')
                        ->join('users', 'klaim_asuransi.user_id', '=', 'users.id')
                        ->join('pasien', 'klaim_asuransi.id_pasien', '=', 'pasien.id')
                        ->join('tipe_asuransi', 'klaim_asuransi.id_tipe_asuransi', '=', 'tipe_asuransi.id')
                        ->select('klaim_asuransi.*', 'tipe_asuransi.nama AS nama_asuransi', 'users.name', 'status.status as status_klaim', 'pasien.nama_lengkap')
                        ->where('id_statusklaim', '<>', 1);

        $tipe_asuransi = TipeAsuransi::get();
        

        if ($request->status) 
        {
            $reimburse = $reimburse->where('id_statusklaim', '=', $request->status);
        }

        if ($request->tipe_asuransi)
        {
            $reimburse = $reimburse->where('tipe_asuransi.id', $request->tipe_asuransi);
        }

        if ($request->start_date && $request->end_date) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
            $reimburse = $reimburse->whereBetween('klaim_asuransi.updated_at', [$startDate, $endDate]);
        }

        if ($request->pencarian) {
            $reimburse = $reimburse->where(function($reimburse) use ($request) {
                $reimburse->where('tipe_asuransi.nama', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('pasien.nama_lengkap', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('klaim_asuransi.obat', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('klaim_asuransi.tindakan', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('klaim_asuransi.lab', 'LIKE', '%'.$request->pencarian.'%');
            });
        }

        $reimburse = $reimburse->paginate(10);
        return view('pages.reimburse.search', compact('reimburse', 'tipe_asuransi', 'startDate', 'endDate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function klaimInsurance(Request $request)
    {
        if (isset($request->id)) {
            $claimed = KlaimAsuransi::find($request->id);

            $claimed->id_statusklaim = (isset($request->status) ? $request->status : 2);
            $claimed->save();

            return response()->json(['message' => 'Data berhasil di proses.']);
        }

        return response()->json(['message' => 'Data Tidak dapat diproses. ada kesalahan pada sistem']);
    }

    /**
     * Export data into excel.
     * 
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export(Request $request) 
    {
        return Excel::download(new ReimburseExport(), 'data_reimburse.xlsx');    
    }

    /**
     * Export data into excel.
     * 
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function exportPdf() 
    {
        return Excel::download(new ReimburseExport(), 'data_reimburse.pdf', 'Dompdf');    
    }

    /**
     * Showing report data.
     * 
     * @return 
     */
    public function report() 
    {
        $total_user = DB::table('users')->count();
        $total_klaim = DB::table('klaim_asuransi')->count();
        $tipe_asuransi = DB::table('tipe_asuransi')->get();

        $pendapatan = DB::table('klaim_asuransi')
                        ->join('tipe_asuransi', 'klaim_asuransi.id_tipe_asuransi', '=', 'tipe_asuransi.id')
                        ->orderBy('klaim_asuransi.updated_at', 'asc')
                        ->select(DB::raw('MONTHNAME(klaim_asuransi.updated_at) as bulan, YEAR(klaim_asuransi.updated_at) as year, (sum(klaim_asuransi.harga_obat) + sum(klaim_asuransi.harga_lab) + sum(klaim_asuransi.harga_tindakan)) as jumlah_bayaran'))
                        ->groupBy(DB::raw('MONTHNAME(klaim_asuransi.updated_at), YEAR(klaim_asuransi.updated_at)'))->get();

        $persentase_asuransi = DB::table('klaim_asuransi')
                                    ->join('tipe_asuransi', 'klaim_asuransi.id_tipe_asuransi', '=', 'tipe_asuransi.id')
                                    ->orderBy('klaim_asuransi.updated_at', 'desc')
                                    ->groupBy('tipe_asuransi.nama')
                                    ->select('tipe_asuransi.nama as nama', DB::raw('count(klaim_asuransi.id_tipe_asuransi) as jumlah, count(klaim_asuransi.id_tipe_asuransi) * 100 / (select count(*) from klaim_asuransi where id_statusklaim = \'3\')  as persentasi'))
                                    ->where('id_statusklaim', '3')
                                    ->paginate(5);

        $pasien = Pasien::paginate(5);

        return view('pages.reimburse.report', compact('total_klaim', 'tipe_asuransi', 'persentase_asuransi', 'pasien', 'pendapatan'));
    }
}
