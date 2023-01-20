<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'json',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'json' => 'json',
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

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getRouteKey(): string
    {
        return Hashids::encode($this->getKey());
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $value = Hashids::decode($value)[0] ?? null;

        return $this->find($value);
    }
}
