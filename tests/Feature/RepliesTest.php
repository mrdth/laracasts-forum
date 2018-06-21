<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\HandlesReplies;
use Tests\Traits\HandlesThreads;

class RepliesTest extends TestCase
{
    use DatabaseMigrations;
    use HandlesThreads;
    use HandlesReplies;

    public function testAuthenticatedUserCanReplyToThread()
    {
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->raw();

        $this->actingAs($user = factory('App\User')->create())
            ->post($this->replyStoreRoute($thread), $reply);

        $this->get($this->threadShowRoute($thread))
            ->assertSee($reply['body']);

    }

    public function testGuestsCannotReplyToThread()
    {
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->raw();

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post($this->replyStoreRoute($thread), $reply);

    }
}
