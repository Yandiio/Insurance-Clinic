<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KlaimAsuransi;
use App\Exports\ReimburseExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $reimburse = KlaimAsuransi::where(function($e) use($request) {
            return $e->where('id_statusklaim', $request->status);
        })->paginate(10);

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
            $claimed = KlaimAsuransi::find($id);

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
