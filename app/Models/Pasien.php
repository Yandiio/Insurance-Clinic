<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pasien';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attribute key associated with the table.
     *
     * @var array
     */

    protected $fillable = ['nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'usia', 'jenis_kelamin', 'golongan_darah', 'harga_obat', 'harga_tindakan', 'harga_lab', 'created_at', 'updated_at'];

    public function klaimAsuransi(): HasMany
    {
        return $this->hasMany(KlaimAsuransi::class);
    }
}
