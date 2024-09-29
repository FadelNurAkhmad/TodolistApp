<?php

namespace Tests\Feature;

use App\Services\Impl\UserServiceImpl;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        // Explicitly bind the service if necessary
        $this->app->singleton(UserService::class, UserServiceImpl::class);

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("parjo", "rahasia"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("rarjo", "rarjo"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("parjo", "salah"));
    }
}
