<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'detail'];
    protected $table = 'categories';

    public function product()
    {
        return $this->hasMany('App\Models\Backend\Product', 'category_id','id');
    }
}
