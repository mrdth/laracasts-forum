<?php
/**
 * Created by PhpStorm.
 * User: mrdth
 * Date: 21/06/18
 * Time: 21:37
 */

namespace Tests\Traits;


use App\Thread;

trait HandlesReplies
{
    protected function replyStoreRoute(Thread $thread): string
    {
        return route('reply.store', $thread);
    }

    protected function makeTestReply($attributes = [])
    {
        return factory('App\Reply')->make($attributes);
    }

    protected function createTestReply($attributes = [])
    {
        return factory('App\Reply')->create($attributes);
    }
}