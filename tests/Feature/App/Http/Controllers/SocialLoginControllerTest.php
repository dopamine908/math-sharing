<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\One\User as SocialiteUser;
use Tests\TestCase;

class SocialLoginControllerTest extends TestCase
{
    use RefreshDatabase;

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
    public function redirectToSocialPlatform_not_support_social_platform_redirect()
    {
        // Arrange
        $route = route('social-login.redirect', ['social_platform' => 'not_support']);

        // Actual
        $response = $this->get($route);

        // Assert
        $response->assertRedirect(route('home', ['error' => 'wrong_social_platform']));
    }

    /**
     * @test google 登入(第一次註冊)跳轉到登入成功頁面，帶 ott
     */
    public function handleSocialPlatformCallback_first_register_success()
    {
        // Arrange
        $route = route('social-login.callback', ['social_platform' => 'google']);
        $stubSocialiteUser = $this->getStubSocialiteUser();
        Socialite::shouldReceive('driver')
            ->with('google')
            ->once()
            ->andReturnSelf()
            ->shouldReceive('user')
            ->once()
            ->andReturn($stubSocialiteUser);

        // Actual
        $response = $this->get($route);

        // Assert
        $this->assertDatabaseHas('users', [
            'name' => 'test_user_name',
            'email' => 'test@gmail.com',
            'avatar' => 'test_avatar_url',
            'provider_id' => '123456789',
            'platform' => 'google',
        ]);
        $response->assertHeader('Authorization');
    }

    /**
     * @test google 登入(已經註冊過)跳轉到登入成功頁面，帶 ott
     */
    public function handleSocialPlatformCallback_login_success()
    {
        // Arrange
        User::factory()->count(1)->create(
            [
                'name' => 'test_user_name',
                'email' => 'test@gmail.com',
                'avatar' => 'test_avatar_url',
                'provider_id' => '123456789',
                'platform' => 'google',
            ]
        );
        $route = route('social-login.callback', ['social_platform' => 'google']);
        $stubSocialiteUser = $this->getStubSocialiteUser();
        Socialite::shouldReceive('driver')
            ->with('google')
            ->once()
            ->andReturnSelf()
            ->shouldReceive('user')
            ->once()
            ->andReturn($stubSocialiteUser);

        // Actual
        $response = $this->get($route);

        // Assert
        $this->assertDatabaseHas('users', [
            'name' => 'test_user_name',
            'email' => 'test@gmail.com',
            'avatar' => 'test_avatar_url',
            'provider_id' => '123456789',
            'platform' => 'google',
        ]);
        $this->assertDatabaseCount('users', 1);
        $response->assertHeader('Authorization');
    }

    /**
     * @test 非認證的社群登入 跳轉到首頁帶 error
     */
    public function handleSocialPlatformCallback_not_support_social_platform_redirect()
    {
        // Arrange
        $route = route('social-login.callback', ['social_platform' => 'not_support']);

        // Actual
        $response = $this->get($route);

        // Assert
        $response->assertRedirect(route('home', ['error' => 'wrong_social_platform']));
    }

    /**
     * @test
     */
    public function login_user_logout()
    {
        // Arrange
        User::factory()->count(1)->create(
            [
                'name' => 'test_user_name',
                'email' => 'test@gmail.com',
                'avatar' => 'test_avatar_url',
                'provider_id' => '123456789',
                'platform' => 'google',
            ]
        );
        $route = route('logout');
        $token = Auth::guard('api')->tokenById(1);

        // Actual
        $response = $this->withHeaders(
            [
                'Authorization' => "Bearer {$token}"
            ]
        )->get($route);

        // Assert
        $response->assertJson(
            [
                'message' => 'already logout'
            ]
        );
        $response->assertStatus(200);
        $this->assertFalse(Auth::guard('api')->check());
    }

    /**
     * @test
     */
    public function not_login_user_logout()
    {
        // Arrange
        $route = route('logout');

        // Actual
        $response = $this->get($route);

        // Assert
        $response->assertJson(
            [
                'message' => 'already logout'
            ]
        );
        $response->assertStatus(200);
        $this->assertFalse(Auth::guard('api')->check());
    }

    /**
     * @return SocialiteUser|mixed|\PHPUnit\Framework\MockObject\Stub
     */
    private function getStubSocialiteUser(): mixed
    {
        $stubSocialiteUser = $this->createStub(SocialiteUser::class);
        $stubSocialiteUser->method('getName')->willReturn('test_user_name');
        $stubSocialiteUser->method('getEmail')->willReturn('test@gmail.com');
        $stubSocialiteUser->method('getAvatar')->willReturn('test_avatar_url');
        $stubSocialiteUser->method('getId')->willReturn('123456789');
        return $stubSocialiteUser;
    }
}
