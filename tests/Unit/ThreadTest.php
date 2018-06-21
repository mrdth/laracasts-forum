<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function testThreadHasReplies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function testThreadHasAnAuthor()
    {
        $this->assertInstanceOf('App\User', $this->thread->author);
    }

    public function testThreadCanAddReply()
    {
        $reply = [
            'user_id' => 1,
            'body' => 'Test reply',
        ];

        $this->thread->addReply($reply);

        $this->assertCount(1, $this->thread->replies);
        $this->assertDatabaseHas('replies', $reply);

    }

}
