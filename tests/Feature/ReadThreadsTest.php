<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\HandlesReplies;
use Tests\Traits\HandlesThreads;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use HandlesThreads;
    use HandlesReplies;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = $this->createTestThread();
    }

    public function testUserCanBrowseThreads()
    {
        $this->get($this->threadIndexRoute())
            ->assertStatus(200)
            ->assertSee($this->thread->title);

    }

    public function testUserCanViewThread()
    {
        $this->get($this->threadShowRoute($this->thread))
            ->assertStatus(200)
            ->assertSee($this->thread->title);
    }

    public function testUserCanReadRepliesForThread()
    {
        $reply = $this->createTestReply(['thread_id' => $this->thread->id]);

        $this->get($this->threadShowRoute($this->thread))
            ->assertStatus(200)
            ->assertSee($reply->body);
    }
}
