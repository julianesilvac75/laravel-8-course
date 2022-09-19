<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable = ['title', 'content', 'user_id'];

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelations(Builder $query)
    {
        return $query->latest()->withCount('comments')
            ->with('user')
            ->with('tags');
    }

    static function boot()
    {
        // since SoftDeletes trait already uses a global scopes that prevents users to see deleted posts,
        // the DeletedAdminScope has to come before the parent::boot()
        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();
        
        // delete event for tables with foreign keys
        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comments()->delete();
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });

        // check if there was any changes on the cached content of the blog post
        static::updating(function (BlogPost $blogPost) {
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }
}
