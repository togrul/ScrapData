<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    //bu hisse normalda database da ayri bir table da olacaq . Sadece numune kimi helelik const variable olaraq saxlayiram.
    const TRENDYOL=1;
    const DEFACTO=2;

    protected $fillable = [
        'seller_id',
        'name',
        'price',
        'is_completed',
        'created_at',
        'updated_at',
    ];
}
