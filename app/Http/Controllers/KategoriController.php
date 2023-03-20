<?php

namespace App\Http\Controllers;

use App\Models\JenisPenyakit;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_penyakit = JenisPenyakit::orderBy('created_at', 'DESC')->paginate(7);
        return view('pages.kategori.index', compact('jenis_penyakit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kategori.create');
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
            'nama_penyakit' => 'required'
        ]);

        JenisPenyakit::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Jenis Penyakit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis_penyakit = JenisPenyakit::find($id);
        return view('pages.kategori.view', compact('jenis_penyakit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis_penyakit = JenisPenyakit::find($id);
        return view('pages.kategori.edit', compact('jenis_penyakit'));
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
            'nama_penyakit' => 'required'
        ]);

        $jenis_penyakit = JenisPenyakit::find($id);
        $jenis_penyakit->nama_penyakit = $request->get('nama_penyakit');
        $jenis_penyakit->save();

        return redirect()->route('kategori.index')->with('success', 'Jenis Penyakit berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis_penyakit = JenisPenyakit::find($id);
        $jenis_penyakit->delete();    
    
        return redirect()->route('kategori.index')->with('success', 'Jenis Penyakit berhasil dihapus');
    }
}
