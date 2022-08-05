<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function scopeSearch($query, Request $request)
    {
        $query->when($request->keyword, function ($query, $keyword) {
            $query->orWhere('title', 'LIKE', "%$keyword%");
            $query->orWhere('content', 'LIKE', "%$keyword%");
            $query->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        });

        $query->when($request->selected_tag, function ($query, $tags) {
            $query->orWhereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tags.id', $tags);
            });
        });

        return $query;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
