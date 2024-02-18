<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductsM extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "products";
    protected $fillable = ["id", "nama_produk", "harga_produk","kategori"];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at' => 'datetime',
    ];
}