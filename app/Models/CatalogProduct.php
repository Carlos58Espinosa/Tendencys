<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogProduct extends Model
{
    protected $table = 'catalog_products';
    protected $guarded = ['id'];
    public $timestamps = false;
}
