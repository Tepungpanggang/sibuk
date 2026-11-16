<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_year',
        'publisher',
        'category_id',
        'shelf_id',
        'stock',
        'cover_path',
        'description',
        'status',
    ];

    public function getCoverUrlAttribute(): string
    {
        return $this->cover_path
            ? asset('storage/' . $this->cover_path)
            : asset('images/cover-default.svg');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
