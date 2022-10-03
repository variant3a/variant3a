<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function scopeSearch($query, Request $request)
    {
        $sort = $request->sort_tag ? 'desc' : 'asc';

        $query->when($request->filter, function ($query, $filter) {
            $query->where('name', 'LIKE', "%$filter%");
        });

        $query->orderBy('name', $sort);

        return $query;
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function timelines()
    {
        return $this->belongsToMany(Timeline::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
