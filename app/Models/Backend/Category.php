<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['en_name', 'ar_name', 'en_detail', 'ar_detail'];
    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany('App\Models\Backend\Product', 'category_id','id');
    }
}
