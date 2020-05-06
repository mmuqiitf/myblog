<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function getThumbnail()
    {
        if (substr($this->thumbnail, 0, 5) == "https") {
            return $this->thumbnail;
        }
        if ($this->thumbnail) {
            return asset($this->thumbnail);
        }
        return 'https://via.placeholder.com/1140x500.png?text=No+Cover';
    }
    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLike()
    {
        return $this->likes->where('user_id', auth()->id())->count();
    }

    public function isFeatured($post_id)
    {
        return $this->where('id', $post_id)->where('featured', 0)->first();
    }

    public function removeTags($value)
    {
        return strip_tags($value, '<p><a><h1><h2><h3><h4><h5><h6><span><i><b>');
    }
}
