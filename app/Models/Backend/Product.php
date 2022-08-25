<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'language', 'category', 'price'];
    protected $table = 'products';

    public function category()
    {
        return $this->hasOne('App\Models\Backend\Category', 'id','category_id');
    }
}
