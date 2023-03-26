<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StatusReimburse extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status';

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

    protected $fillable = ['status', 'created_at', 'updated_at'];

    public function klaimAsuransi(): HasOne
    {
        return $this->hasOne(KlaimAsuransi::class);
    }
}
