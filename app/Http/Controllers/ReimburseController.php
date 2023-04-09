<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KlaimAsuransi;
use App\Exports\ReimburseExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

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
        
        return view('pages.reimburse.index', ['reimburse' => $reimburse]);
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

        if ($request->status) {
            $reimburse = $reimburse->where('id_statusklaim', '=', $request->status);
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
        return view('pages.reimburse.search', compact('reimburse'));
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

            $claimed->id_statusklaim = 3;
            // $claimed->updated_at = Carbon::now();
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
    public function export() 
    {
        return Excel::download(new ReimburseExport, 'data_reimburse.xlsx');    
    }
}
