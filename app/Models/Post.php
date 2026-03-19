<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['subject_id', 'title', 'slug', 'content', 'is_published'];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}