<?php
/**
 * Created by PhpStorm.
 * User: mrdth
 * Date: 21/06/18
 * Time: 21:33
 */

namespace Tests\Traits;


use App\Thread;

trait HandlesThreads
{
    protected function threadIndexRoute(): string
    {
        return route('threads.index');
    }

    protected function threadShowRoute(Thread $thread): string
    {
        return $thread->getUri();
    }

    protected function threadStoreRoute(): string
    {
        return route('threads.store');
    }

    protected function threadCreateRoute()
    {
        return route('threads.create');
    }

    protected function makeTestThread($attributes = [])
    {
        return factory('App\Thread')->make($attributes);
    }

    protected function createTestThread($attributes = [])
    {
        return factory('App\Thread')->create($attributes);
    }
}