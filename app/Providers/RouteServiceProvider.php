<?php

namespace App\Providers;

use App\Http\Middleware\JwtAuthenticationMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // 註冊社群登入 Routes
            $this->registerAuthenticationRoute();

            // 註冊 web Routes
            $this->registerWebRoutes();

            // 註冊 Api Routes（需驗證）
            $this->registerApiAuthRoutes();

            // 註冊 Api Routes（不需驗證）
            $this->registerApiPublicRoutes();

            // 註冊 Api Routes（不需驗證）
            $this->registerApiAdminRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    private function registerWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    private function registerAuthenticationRoute()
    {
        Route::namespace($this->namespace)
            ->group(base_path('routes/authentication.php'));
    }

    protected function registerApiPublicRoutes()
    {
        foreach (glob(base_path('routes/public/*.php')) as $file) {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group($file);
        }
    }

    protected function registerApiAuthRoutes()
    {
        foreach (glob(base_path('routes/auth/*.php')) as $file) {
            Route::prefix('api')
                ->middleware(['api', JwtAuthenticationMiddleware::class])
                ->namespace($this->namespace)
                ->group($file);
        }
    }

    protected function registerApiAdminRoutes()
    {
        foreach (glob(base_path('routes/admin/*.php')) as $file) {
            Route::prefix('api/admin')
                ->middleware(['api', JwtAuthenticationMiddleware::class])
                ->namespace($this->namespace)
                ->group($file);
        }
    }
}
