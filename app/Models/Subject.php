<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = ['name', 'slug'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }
    
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_subject')->withTimestamps();
    }
}
