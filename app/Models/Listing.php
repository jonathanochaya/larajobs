<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'company', 'location', 'website',
        'email', 'description', 'tags', 'logo'
    ];

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false) {
            return $query->where('tags', 'like', '%' . $filters['tag'] . '%');
        } elseif($filters['search'] ?? false) {
            return $query
                ->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                ->orWhere('tags', 'like', '%'. $filters['search'] . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
