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
        $thread = $this->makeTestThread();
        $thread->save();
        $reply = $this->makeTestReply();

        $this->signIn()
            ->post($this->replyStoreRoute($thread), $reply->toArray());

        $this->get($this->threadShowRoute($thread))
            ->assertSee($reply['body']);

    }

    public function testGuestsCannotReplyToThread()
    {
        $thread = $this->makeTestThread();
        $thread->save();
        $reply = $this->makeTestReply();

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post($this->replyStoreRoute($thread), $reply->toArray());

    }
}
