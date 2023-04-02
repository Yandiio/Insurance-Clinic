<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:pasien-list|pasien-create|pasien-edit|pasien-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pasien-create', ['only' => ['create','store']]);
        $this->middleware('permission:pasien-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pasien-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = Pasien::orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.pasien.index', ['pasien'=>$pasien]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pasien.create');
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
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'golongan_darah' => 'required',
            'alamat' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['agama'] = 'Islam';
        Pasien::create($requestData);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasien = Pasien::find($id);
        return view('pages.pasien.view', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = Pasien::find($id);
        return view('pages.pasien.edit', compact('pasien'));
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
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'golongan_darah' => 'required',
            'alamat' => 'required',
        ]);

        $pasien = Pasien::find($id);
        $pasien->nik = $request->get('nik');
        $pasien->nama_lengkap = $request->get('nama_lengkap');
        $pasien->tempat_lahir = $request->get('tempat_lahir');
        $pasien->tanggal_lahir = $request->get('tanggal_lahir');
        $pasien->alamat = $request->get('alamat');
        $pasien->usia = $request->get('usia');
        $pasien->jenis_kelamin = $request->get('jenis_kelamin');
        $pasien->golongan_darah = $request->get('golongan_darah');
        $pasien->agama = $request->get('agama');
        $pasien->harga_obat = $request->get('harga_obat');
        $pasien->harga_tindakan = $request->get('harga_obat');
        $pasien->harga_lab = $request->get('harga_lab');

        $pasien->save();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();    
    
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus');
    }
}
