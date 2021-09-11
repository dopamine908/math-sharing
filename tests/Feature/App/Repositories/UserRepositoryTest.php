<?php

namespace Tests\Feature\App\Repositories;

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
    public function GivenUserData_WhenCallCreateUser_ThenCheckInsertSuccessAndReturnModelUser()
    {
        $this->specify('測試 createUser，新增使用者成功，確認資料庫有該使用者資料＋確認回傳為 App\Models\User', function () {
            // Arrange
            $name = 'test_name';
            $email = 'test@gmail.com';
            $avatar = 'test_avatar_url';
            $providerId = '123456789';
            $platform = 'google';
            $UserRepository = new UserRepository();

            // Actual
            $actual = $UserRepository->createUser(
                name:       $name,
                email:      $email,
                avatar:     $avatar,
                providerId: $providerId,
                platform:   $platform,
            );

            // Assert
            $this->assertInstanceOf(expected: User::class, actual: $actual);
            $this->assertDatabaseHas(
                table: 'users',
                data:  [
                           'name' => $name,
                           'email' => $email,
                           'avatar' => $avatar,
                           'provider_id' => $providerId,
                           'platform' => $platform,
                       ]
            );
        });
    }

    /**
     * @test
     */
    public function GivenUserInDb_WhenCallGetUserByEmailAndPlatform_ThenCheckGetTheUser()
    {
        $this->specify('測試 getUserByEmailAndPlatform，當使用者存在，成功取得使用者', function () {
            // Arrange
            $name = 'test_name';
            $email = 'test@gmail.com';
            $avatar = 'test_avatar_url';
            $providerId = '123456789';
            $platform = 'google';
            User::factory()->count(1)->create(
                [
                    'name' => $name,
                    'email' => $email,
                    'avatar' => $avatar,
                    'provider_id' => $providerId,
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
                              'provider_id' => $providerId,
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
        });
    }

    /**
     * @test
     */
    public function GivenUserInDb_WhenCallGetUserByEmailAndPlatform_ThenUserNotFoundReturnNull()
    {
        $this->specify('測試 getUserByEmailAndPlatform，當使用者不存在，回傳 null', function () {
            // Arrange
            $email = 'test@gmail.com';
            $platform = 'google';

            $UserRepository = new UserRepository();

            // Actual
            $actual = $UserRepository->getUserByEmailAndPlatform(email: $email, platform: $platform);

            // Assert
            $this->assertEquals(expected: null, actual: $actual);
        });
    }
}
