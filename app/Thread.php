<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thread extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'body'];

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply($reply): Thread
    {
        $this->replies()->create($reply);
        return $this;
    }

    public function getUri()
    {
        return route('threads.show', [
            'channel' => $this->channel,
            'thread' => $this
        ]);
    }
}
