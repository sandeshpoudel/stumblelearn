<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return (bool) $this->is_admin;
    }

    public function savedPosts(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Post::class, 'saved_posts')->withTimestamps();
    }

    public function ignoredPosts(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Post::class, 'ignored_posts')->withTimestamps();
    }

    public function understoodPosts(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Post::class, 'understood_posts')->withPivot('points')->withTimestamps();
    }

}
