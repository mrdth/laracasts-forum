<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\HandlesThreads;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use HandlesThreads;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function testUserCanBrowseThreads()
    {
        $this->get('/threads')
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
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get($this->threadShowRoute($this->thread))
            ->assertStatus(200)
            ->assertSee($reply->body);
    }
}
