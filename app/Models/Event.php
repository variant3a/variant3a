<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'title',
        'description',
        'url',
        'location',
        'color',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'all_day' => 'boolean',
    ];

    public function scopeSearch($query, Request $request)
    {
        $query->when($request->keyword, function ($query, $keyword) {
            $query->orWhere('title', 'LIKE', "%$keyword%");
            $query->orWhere('description', 'LIKE', "%$keyword%");
            $query->orWhere('url', 'LIKE', "%$keyword%");
            $query->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        });

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
