<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category','name','sku','description','price','status'];

    public function Category(){
        return $this->belongsTo('App\Models\Category','category');
    }

    public function ProductImages(){
        return $this->hasMany('App\Models\ProductImages','product_id');
    }
}
