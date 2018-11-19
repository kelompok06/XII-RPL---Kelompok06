<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";
    protected $fillable = ['kategori_id', 'title', 'content'];

    public function kategori()
    {
       return $this->belongsTo('App\Kategori');
    }
}
