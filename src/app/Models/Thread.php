<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'contents',
        'channel_id',
        'user_id',
        'best_answer_id'
    ];


    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function subscribes(): HasMany
    {
        return $this->hasMany(Subscribe::class);
    }
}
