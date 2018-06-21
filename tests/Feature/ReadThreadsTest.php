<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    private $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function testUserCanBrowseThreads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
        $response->assertSee($this->thread->title);

    }

    public function testUserCanViewThread()
    {
        $response = $this->get('/threads/' . $this->thread->id);

        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    public function testUserCanReadRepliesForThread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $response = $this->get('/threads/' . $this->thread->id);

        $response->assertStatus(200);
        $response->assertSee($reply->body);
    }
}
