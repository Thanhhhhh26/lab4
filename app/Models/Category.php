<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'status'];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function activeNews()
    {
        return $this->hasMany(News::class)->where('status', 1);
    }
}
