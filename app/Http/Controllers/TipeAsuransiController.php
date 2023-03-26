<?php

namespace App\Http\Controllers;

use App\Models\TipeAsuransi;
use Illuminate\Http\Request;

class TipeAsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipe_asuransi = TipeAsuransi::orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.tipe_asuransi.index', ['tipe_asuransi' => $tipe_asuransi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tipe_asuransi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode_asuransi' => 'required',
            'telepon' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        TipeAsuransi::create($request->all());

        return redirect()->route('tipe_asuransi.index')->with('success', 'Tipe Asuransi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipe_asuransi = TipeAsuransi::find($id);
        return view('pages.tipe_asuransi.view', compact('tipe_asuransi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipe_asuransi = TipeAsuransi::find($id);
        return view('pages.tipe_asuransi.edit', compact('tipe_asuransi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kode_asuransi' => 'required',
            'telepon' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        $tipe_asuransi = TipeAsuransi::find($id);
        $tipe_asuransi->nama = $request->get('nama');
        $tipe_asuransi->kode_asuransi = $request->get('kode_asuransi');
        $tipe_asuransi->telepon = $request->get('telepon');
        $tipe_asuransi->email = $request->get('email');
        $tipe_asuransi->alamat = $request->get('alamat');
        $tipe_asuransi->save();

        return redirect()->route('tipe_asuransi.index')->with('success', 'Tipe Asuransi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipe_asuransi = TipeAsuransi::find($id);
        $tipe_asuransi->delete();    
    
        return redirect()->route('tipe_asuransi.index')->with('success', 'Tipe Asuransi berhasil dihapus');
    }
}
