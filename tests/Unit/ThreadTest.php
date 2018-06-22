<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Traits\HandlesThreads;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    use HandlesThreads;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = $this->createTestThread();
    }

    public function testThreadHasReplies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function testThreadHasAnAuthor()
    {
        $this->assertInstanceOf('App\User', $this->thread->author);
    }

    public function testThreadBelongsToChannel()
    {
        $this->assertInstanceOf('App\Channel', $this->thread->channel);
    }

    public function testThreadCanGenerateItsUri()
    {
        $this->assertEquals(
            route('threads.show', ['channel' => $this->thread->channel, 'thread' => $this->thread]),
            $this->thread->getUri()
        );
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
