<?php

namespace Tests\Unit\App\Services\Authentication;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Authentication\SocialLoginService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\One\User as SocialiteUser;
use Tests\TestCase;

class SocialLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function GivenUserExist_WhenCallFindOrCreateUser_ThenCheckNotCalledCreateNewUser()
    {
        $this->specify(
            '測試 findOrCreateUser ，當使用者存在時，驗證不觸發新增一位使用者',
            function () {
                // Arrange
                $mockUserRepository = $this->createMockeryMock(UserRepository::class);
                /** @var SocialLoginService $SocialLoginService */
                $SocialLoginService = $this->app->make(SocialLoginService::class);

                $stubSocialiteUser = $this->getStubSocialiteUser();
                $insertUser = $this->getStubInsertUser();
                $mockUserRepository->shouldReceive('getUserByEmailAndPlatform')
                    ->with('test@gmail.com', 'google')
                    ->once()
                    ->andReturn($insertUser);
                $mockUserRepository->shouldNotReceive('createNewUser');

                // Actual
                $actual = $SocialLoginService->findOrCreateUser($stubSocialiteUser, 'google');

                // Assert
                $this->assertEquals($insertUser, $actual);
            }
        );
    }

    /**
     * @test
     */
    public function GivenUserNotExist_WhenCallFindOrCreateUser_ThenCheckCalledCreateNewUser()
    {
        $this->specify(
            '測試 findOrCreateUser ，當使用者不存在時，驗證觸發新增一位使用者',
            function () {
                // Arrange
                $mockUserRepository = $this->createMockeryMock(UserRepository::class);
                /** @var SocialLoginService $SocialLoginService */
                $SocialLoginService = $this->app->make(SocialLoginService::class);

                $stubSocialiteUser = $this->getStubSocialiteUser();
                $insertUser = $this->getStubInsertUser();
                $mockUserRepository->shouldReceive('getUserByEmailAndPlatform')
                    ->with('test@gmail.com', 'google')
                    ->once()
                    ->andReturn(null);
                $mockUserRepository->shouldReceive('createUser')
                    ->with(
                        'test_user_name',
                        'test@gmail.com',
                        'test_avatar_url',
                        '123456789',
                        'google',
                    )
                    ->once()
                    ->andReturn($insertUser);

                // Actual
                $actual = $SocialLoginService->findOrCreateUser($stubSocialiteUser, 'google');

                // Assert
                $this->assertEquals($insertUser, $actual);
            }
        );
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

    /**
     * @return Collection|Model
     */
    private function getStubInsertUser(): Collection|Model
    {
        $insertUser = User::factory()->make(
            [
                'name' => 'test_user_name',
                'email' => 'test@gmail.com',
                'avatar' => 'test_avatar_url',
                'provider_id' => '123456789',
                'platform' => 'google',
            ]
        );

        return $insertUser;
    }
}
