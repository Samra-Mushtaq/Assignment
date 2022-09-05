<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['en_name', 'ar_name', 'en_description','ar_description', 'status', 'price'];

    public function category()
    {
        return $this->belongsToMany('App\Models\Backend\Category');
    }

    public function images()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
