<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RepliesTest extends TestCase
{
    use DatabaseMigrations;

    protected function replyStoreRoute(Thread $thread): string
    {
        return route('reply.store', $thread);
    }

    protected function threadShowRoute(Thread $thread): string
    {
        return route('threads.show', $thread);
    }

    public function testAuthenticatedUserCanReplyToThread()
    {
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();

        $this->actingAs($user = factory('App\User')->create())
            ->post($this->replyStoreRoute($thread), $reply->toArray());

        $this->get($this->threadShowRoute($thread))
            ->assertSee($reply->body);

    }

    public function testGuestsCannotReplyToThread()
    {
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post($this->replyStoreRoute($thread), $reply->toArray());

    }
}
