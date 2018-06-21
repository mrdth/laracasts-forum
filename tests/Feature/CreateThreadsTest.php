<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\HandlesThreads;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use HandlesThreads;

    public function testUserCanCreateThreads()
    {
        $thread = $this->makeTestThread();

        $this->signIn()
            ->post($this->threadStoreRoute(), $thread->toArray());

        $this->get($this->threadShowRoute(Thread::first()))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function testGuestCannotCreateThreads()
    {
        $thread = $this->makeTestThread();

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post($this->threadStoreRoute(), $thread->toArray());
    }
}
