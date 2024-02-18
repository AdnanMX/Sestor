<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TransactionsItemM extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "transactions_item";
    protected $fillable = ["id_transactions", "id_products", "nama_produk", "harga_produk", "quantity"];
    protected $dates = ['deleted_at'];
}
