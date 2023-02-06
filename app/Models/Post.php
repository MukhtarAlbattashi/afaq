<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body','slug', 'preview','image','tags'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'active' => 'boolean',
    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('title', 'like', $term);
        });
    }
}
