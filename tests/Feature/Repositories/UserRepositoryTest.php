<?php

namespace Tests\Feature\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function createUser()
    {
        // Arrange
        $name = 'test_name';
        $email = 'test@gmail.com';
        $avatar = 'test_avatar_url';
        $provider_id = '123456789';
        $platform = 'google';
        $UserRepository = new UserRepository();

        // Actual
        $actual = $UserRepository->createUser(
            name:        $name,
            email:       $email,
            avatar:      $avatar,
            provider_id: $provider_id,
            platform:    $platform,
        );

        // Assert
        $this->assertInstanceOf(expected: User::class, actual: $actual);
        $this->assertDatabaseHas(
            table: 'users',
            data:  [
                       'name' => $name,
                       'email' => $email,
                       'avatar' => $avatar,
                       'provider_id' => $provider_id,
                       'platform' => $platform,
                   ]
        );
    }

    /**
     * @test
     */
    public function getUserByEmailAndPlatform_success()
    {
        // Arrange
        $name = 'test_name';
        $email = 'test@gmail.com';
        $avatar = 'test_avatar_url';
        $provider_id = '123456789';
        $platform = 'google';
        User::factory()->count(1)->create(
            [
                'name' => $name,
                'email' => $email,
                'avatar' => $avatar,
                'provider_id' => $provider_id,
                'platform' => $platform,
            ]
        );
        $UserRepository = new UserRepository();

        // Actual
        $actual = $UserRepository->getUserByEmailAndPlatform(email: $email, platform: $platform);

        // Assert
        $this->assertInstanceOf(
            expected: User::class,
            actual:   $actual
        );
        $this->assertEquals(
            expected: [
                          'name' => $name,
                          'email' => $email,
                          'avatar' => $avatar,
                          'provider_id' => $provider_id,
                          'platform' => $platform,
                      ],
            actual:   [
                          'name' => $actual->name,
                          'email' => $actual->email,
                          'avatar' => $actual->avatar,
                          'provider_id' => $actual->provider_id,
                          'platform' => $actual->platform,
                      ]
        );
    }

    /**
     * @test
     */
    public function getUserByEmailAndPlatform_not_found()
    {
        // Arrange
        $email = 'test@gmail.com';
        $platform = 'google';

        $UserRepository = new UserRepository();

        // Actual
        $actual = $UserRepository->getUserByEmailAndPlatform(email: $email, platform: $platform);

        // Assert
        $this->assertEquals(expected: null, actual: $actual);
    }
}
