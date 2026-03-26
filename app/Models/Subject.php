<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = ['course_id', 'name', 'slug'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    // public function posts(): HasMany
    // {
    //     return $this->hasMany(Post::class);
    // }
    
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_subject')->withTimestamps();
    }
}