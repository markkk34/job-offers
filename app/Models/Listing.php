<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'email',
        'website',
        'tags',
        'description',
    ];

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['tag'])) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if (!empty($filters['search'])) {
            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('company', 'like', '%' . request('search') . '%');
        }
    }
}
