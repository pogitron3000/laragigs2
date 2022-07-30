<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') .'%');
        }

        if($filters['search'] ?? false) {
            $query->where('tags', 'like', '%' . request('search') .'%')
                  ->orWhere('title', 'like', '%' . request('search') .'%')
                  ->orWhere('company', 'like', '%' . request('search') .'%')
                  ->orWhere('location', 'like', '%' . request('search') .'%');
        }
    }
}
