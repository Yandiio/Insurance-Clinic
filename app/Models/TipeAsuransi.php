<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeAsuransi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipe_asuransi';

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

    protected $fillable = ['nama', 'kode_asuransi', 'telepon', 'email', 'alamat', 'created_at', 'updated_at'];
}
