<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thread extends Model
{
    public function Replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
