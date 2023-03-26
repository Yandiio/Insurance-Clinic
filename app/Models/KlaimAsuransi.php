<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KlaimAsuransi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'klaim_asuransi';

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

    protected $fillable = ['user_id', 'id_pasien', 'id_tipe_asuransi', 'tindakan', 'lab', 'obat', 'id_statusklaim', 'no_klaim','created_at', 'updated_at'];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function asuransi(): BelongsTo {
        return $this->belongsTo(TipeAsuransi::class, 'id_tipe_asuransi');    
    }

    public function statusKlaim(): BelongsTo {
        return $this->belongsTo(StatusReimburse::class, 'id_statusklaim');        
    }
}
