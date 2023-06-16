<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = Pasien::orderBy('created_at', 'DESC')->paginate(10);

        // $client = new Client();
        // $response = $client->request('GET', 'http://34.173.187.215/pasien');

        // if ($response->getStatusCode() == 200) {
        //     $pasien = json_decode($response->getBody(), true);
        // }

        return view('pages.pasien.index', ['pasien'=> $pasien]);
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
     * Display the specified resource into json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        if (isset($request->id)) {
            $pasien = Pasien::find($request->id);
            return response()->json(['message'=>'success', 'data' => $pasien]);
        }
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
     * Update the specified resource in storage.s
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
