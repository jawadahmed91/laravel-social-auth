<?php

namespace Tests;

use JawadAhmed\SocialAuth\SocialAuthController;
use JawadAhmed\SocialAuth\SocialUserLinker;
use PHPUnit\Framework\TestCase;

final class SocialAuthControllerTest extends TestCase
{
    public function test_controller_requires_a_linker(): void
    {
        $linker = $this->createMock(SocialUserLinker::class);
        self::assertInstanceOf(SocialAuthController::class, new SocialAuthController($linker));
    }
}
