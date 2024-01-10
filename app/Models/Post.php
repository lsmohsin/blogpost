<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\PostObserver;

class Post extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::observe(PostObserver::class);
    }
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value); // Convert the title to uppercase before saving
    }
    public function scopeFilterByTags($query, $tagIds)
    {

        return $query->whereHas('tags', function ($q) use ($tagIds) {
            $q->whereIn('tags.id', $tagIds);
        });
    }
}
