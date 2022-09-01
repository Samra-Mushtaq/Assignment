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
        return $this->belongsToMany('App\Models\Backend\Product');
    }

    //Model Events
    // protected static function booted()
    // {
    //     static::deleting(function ($category) {
    //         //
    //         return false;
    //     });
    // }
}
