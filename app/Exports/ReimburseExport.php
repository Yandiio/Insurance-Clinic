<?php

namespace App\Exports;

use App\Models\KlaimAsuransi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ReimburseExport implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $collect = DB::select('select ka.tindakan, ka.obat, ka.lab, ka.no_klaim, sk.status, ta.nama, ta.kode_asuransi, p.nama_lengkap, p.usia, p.jenis_kelamin, p.golongan_darah, p.harga_obat, p.harga_tindakan, p.harga_lab, u.name as dilayani_oleh
                        from klaim_asuransi ka
                        join status sk on sk.id = ka.id_statusklaim
                        join tipe_asuransi ta on ta.id = ka.id_tipe_asuransi
                        join users u on u.id = ka.user_id
                        join pasien p on p.id = ka.id_pasien
                        where id_statusklaim <> \'1\'');

        return view('export.reimburse', ['collect' => $collect]);
    }
}
