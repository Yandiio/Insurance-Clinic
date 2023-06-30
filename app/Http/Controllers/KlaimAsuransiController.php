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
        $url = 'http://45.76.183.118/api/list-pasien';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow any redirects
        curl_setopt($ch, CURLOPT_HTTPGET, true); // Set the request method to GET

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        $pasien = json_decode($response)->data;
        $jenis_penyakit = JenisPenyakit::get();
        $asuransi = TipeAsuransi::get();

        
        for ($i = 0; $i < count($pasien); $i++) {
            $pasien_exist = Pasien::where('nama_lengkap', 'LIKE', '%'.$pasien[$i]->nama_lengkap.'%')->first();

            if (isset($pasien_exist)){
                unset($pasien[$i]);
            }
        }

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
            'tipe_asuransi' => 'required',
        ]);


        try {
            $pasien = Pasien::create([
                'nama_lengkap' => $request->nama,
                'nik' => $request->nik, 
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat, 
                'usia' => $request->usia, 
                'jenis_kelamin' => $request->jenis_kelamin, 
                'golongan_darah' => $request->golongan_darah, 
            ]);

            if (isset($pasien)) {
                KlaimAsuransi::create([
                    'user_id' => auth()->user()->id,
                    'id_pasien' => $pasien->id,
                    'id_tipe_asuransi' => $request->tipe_asuransi,
                    'tindakan' => $request->tindakan,
                    'lab' => $request->lab,
                    'obat' => $request->obat,
                    'harga_obat' => $request->harga_obat,
                    'harga_tindakan' => $request->harga_tindakan, 
                    'id_statusklaim' => 1,
                    'no_klaim' => 'IFZ/'.mt_rand(100, 900).'/'.mt_rand(100,900),
                ]);
            }
    
            return redirect()->route('klaimasuransi.index')->with('success', 'klaim berhasil ditambahkan');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
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

        $url = 'http://45.76.183.118/api/list-pasien';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow any redirects
        curl_setopt($ch, CURLOPT_HTTPGET, true); // Set the request method to GET

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        $pasien = json_decode($response)->data;
        $asuransi = TipeAsuransi::get();

        for ($i = 0; $i < count($pasien); $i++) {
            $pasien_exist = Pasien::where('nama_lengkap', 'LIKE', '%'.$pasien[$i]->nama_lengkap.'%')->first();

            if (isset($pasien_exist)){
                unset($pasien[$i]);
            }
        }

        $pasien_claim = Pasien::find($already_claim->id_pasien);
        $asuransi_claim = TipeAsuransi::find($already_claim->id_tipe_asuransi);

        return view('pages.klaim_asuransi.edit', compact('pasien', 'asuransi', 'already_claim', 'pasien_claim', 'asuransi_claim') );
    }

    public function show(Request $request)
    {
        $url = 'http://45.76.183.118/api/detail-pasien/'.$request->id;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow any redirects
        curl_setopt($ch, CURLOPT_HTTPGET, true); // Set the request method to GET

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        $pasien = json_decode($response);
        return $pasien->data;
    }

    public function view(Request $request)
    {
        $klaim_asuransi = KlaimAsuransi::find($request->id);
        $pasien = Pasien::find($klaim_asuransi->id_pasien);
        
        $data = $klaim_asuransi;
        $data['status'] = $data->id_statusklaim == 1 ? 'Belum diproses': '-';
        $data['pasien'] = $pasien;

        return response()->json(['data' => $data], 200);
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
        $pasien = Pasien::find($request->id);

        if (!isset($pasien)) {
            $pasien_data = Pasien::create([
                'nama_lengkap' => $request->nama,
                'nik' => $request->nik, 
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat, 
                'usia' => $request->usia, 
                'jenis_kelamin' => $request->jenis_kelamin, 
                'golongan_darah' => $request->golongan_darah, 
            ]);

            if (isset($pasien)) {
                $already_claim = KlaimAsuransi::find($id);
    
                $already_claim->user_id = auth()->user()->id;
                $already_claim->id_pasien = $pasien_data->id;
                $already_claim->id_tipe_asuransi = $request->tipe_asuransi;
                $already_claim->tindakan = $request->tindakan;
                $already_claim->lab = $request->lab;
                $already_claim->harga_obat = $request->harga_obat;
                $already_claim->harga_tindakan = $request->harga_tindakan;
                $already_claim->obat = $request->obat;
                $already_claim->id_statusklaim = 2;
            }
        }

        if (isset($pasien)) {
            $already_claim = KlaimAsuransi::find($id);

            $already_claim->user_id = auth()->user()->id;
            $already_claim->id_pasien = $pasien->id;
            $already_claim->id_tipe_asuransi = $request->tipe_asuransi;
            $already_claim->tindakan = $request->tindakan;
            $already_claim->lab = $request->lab;
            $already_claim->harga_obat = $request->harga_obat;
            $already_claim->harga_tindakan = $request->harga_tindakan;
            $already_claim->obat = $request->obat;
            $already_claim->id_statusklaim = 2;
        }


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
        $klaim_asuransi = KlaimAsuransi::findOrFail($id);
        $klaim_asuransi->delete();

        return redirect()->route('klaimasuransi.index')->with('success', 'klaim berhasil dihapus');
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
                                    ->select('tipe_asuransi.nama as nama', DB::raw('count(klaim_asuransi.id_tipe_asuransi) as jumlah,count(klaim_asuransi.id_tipe_asuransi) * 100 / (select count(*) from klaim_asuransi)  as persentasi'))
                                    ->paginate(5);

        $pasien = Pasien::paginate(5);

        return view('pages.klaim_asuransi.report', compact('total_klaim', 'tipe_asuransi', 'persentase_asuransi', 'pasien', 'pendapatan'));
    }
}
