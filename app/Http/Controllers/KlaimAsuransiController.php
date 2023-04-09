<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\JenisPenyakit;
use App\Models\TipeAsuransi;
use App\Models\KlaimAsuransi;
use App\Models\Statusklaim_asuransi;
use Illuminate\Http\Request;
use App\Exports\KlaimAsuransiExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class KlaimAsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klaim_asuransi = KlaimAsuransi::paginate(10);
        return view('pages.klaim_asuransi.index', ['klaim_asuransi' => $klaim_asuransi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pasien = Pasien::get();
        $jenis_penyakit = JenisPenyakit::get();
        $asuransi = TipeAsuransi::get();

        return view('pages.klaim_asuransi.create', compact('pasien', 'jenis_penyakit', 'asuransi') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function claimInsurance(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
        ]);

        KlaimAsuransi::create([
            'user_id' => auth()->user()->id,
            'id_pasien' => $request->nama_lengkap,
            'id_tipe_asuransi' => $request->tipe_asuransi,
            'tindakan' => $request->tindakan,
            'lab' => $request->lab,
            'obat' => $request->obat,
            'id_statusklaim' => 2,
            'no_klaim' => 'IFZ/'.mt_rand(100, 900).'/'.mt_rand(100,900),
        ]);

        return redirect()->route('klaimasuransi.index')->with('success', 'klaim berhasil ditambahkan');
    }

    public function search(Request $request) 
    {
        $klaim_asuransi = DB::table('klaim_asuransi')
                        ->join('status', 'klaim_asuransi.id_statusklaim', '=', 'status.id')
                        ->join('users', 'klaim_asuransi.user_id', '=', 'users.id')
                        ->join('pasien', 'klaim_asuransi.id_pasien', '=', 'pasien.id')
                        ->join('tipe_asuransi', 'klaim_asuransi.id_tipe_asuransi', '=', 'tipe_asuransi.id')
                        ->select('klaim_asuransi.*', 'tipe_asuransi.nama AS nama_asuransi', 'users.name', 'status.status as status_klaim', 'pasien.nama_lengkap');

        if ($request->status) {
            $klaim_asuransi = $klaim_asuransi->where('id_statusklaim', '=', $request->status);
        }

        if ($request->pencarian) {
            $klaim_asuransi = $klaim_asuransi->where(function($klaim_asuransi) use ($request) {
                $klaim_asuransi->where('tipe_asuransi.nama', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('pasien.nama_lengkap', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('klaim_asuransi.obat', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('klaim_asuransi.tindakan', 'LIKE', '%'.$request->pencarian.'%')
                      ->orWhere('klaim_asuransi.lab', 'LIKE', '%'.$request->pencarian.'%');
            });
        }

        $klaim_asuransi = $klaim_asuransi->paginate(10);

        return view('pages.klaim_asuransi.search', compact('klaim_asuransi'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailInsurance($id)
    {
        $already_claim = KlaimAsuransi::find($id);

        $pasien = Pasien::find($already_claim->id_pasien);
        $asuransi = TipeAsuransi::find($already_claim->id_tipe_asuransi);

        return view('pages.klaim_asuransi.view', compact('pasien', 'asuransi', 'already_claim') );
    }

    /**
     * Show the form for editing insurance data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $already_claim = KlaimAsuransi::find($id);

        $pasien = Pasien::get();
        $asuransi = TipeAsuransi::get();

        $pasien_claim = Pasien::find($already_claim->id_pasien);
        $asuransi_claim = TipeAsuransi::find($already_claim->id_tipe_asuransi);

        return view('pages.klaim_asuransi.edit', compact('pasien', 'asuransi', 'already_claim', 'pasien_claim', 'asuransi_claim') );
    }

    /**
     * Update the insurance data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInsurance(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
        ]);

        $already_claim = KlaimAsuransi::find($id);

        $already_claim->user_id = auth()->user()->id;
        $already_claim->id_pasien = $request->nama_lengkap;
        $already_claim->id_tipe_asuransi = $request->tipe_asuransi;
        $already_claim->tindakan = $request->tindakan;
        $already_claim->lab = $request->lab;
        $already_claim->obat = $request->obat;
        $already_claim->id_statusklaim = 3;

        $already_claim->save();

        return redirect()->route('klaimasuransi.index')->with('success', 'klaim berhasil ditambahkan');
    }

    /**
     * Remove the specified insurance from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteInsurance($id)
    {
        //
    }

    /**
     * Export data into excel.
     * 
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export() 
    {
        return Excel::download(new KlaimAsuransiExport, 'data_klaim_asuransi.xlsx');    
    }
}
