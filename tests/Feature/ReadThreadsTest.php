<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    protected function threadShowRoute(Thread $thread): string
    {
        return route('threads.show', $thread);
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
