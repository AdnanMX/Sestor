<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TransactionsM extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "transactions";
    protected $fillable = ["nomor_unik","nama_pelanggan","no_polisi","type","total_harga", "uang_bayar", "uang_kembali"];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(TransactionsItemM::class, 'id_transactions');
    }
}
