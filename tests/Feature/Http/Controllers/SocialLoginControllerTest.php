<?php

namespace Tests\Feature\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class SocialLoginControllerTest extends TestCase
{
    /**
     * @test 測試導向 google 登入
     */
    public function redirectToSocialPlatform_google_pass()
    {
        // Arrange
        $route = route('social-login.redirect', ['social_platform' => 'google']);

        // Assert
        Socialite::shouldReceive('driver')
            ->with('google')
            ->once()
            ->andReturnSelf()
            ->shouldReceive('redirect')
            ->once();

        // Actual
        $this->get($route);
    }

    /**
     * @test 測試導向 非支援的平台 登入
     */
    public function redirectToSocialPlatform_not_support_social_platform_pass()
    {
        // Arrange
        $route = route('social-login.redirect', ['social_platform' => 'not_support']);

        // Actual
        $response = $this->get($route);

        // Assert
        $response->assertRedirect(route('home', ['error' => 'wrong_social_platform']));
    }
}
