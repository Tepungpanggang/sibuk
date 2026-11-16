<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $fillable = ['code', 'location'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}