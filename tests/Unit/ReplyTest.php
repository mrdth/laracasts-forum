<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function testReplyHasAnAuthor()
    {
        $reply = factory('App\Reply')->create();

        $this->assertInstanceOf('App\User', $reply->author);
    }
}
