<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function blogPost()
    {
        return $this->belongsTo('App\Models\BlogPost');
    }

    static function boot()
    {
        parent::boot();
        
        //global scope to order comments by the newest
        static::addGlobalScope(new LatestScope);
    }
}
