<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Family;
use App\Models\Student;
use App\Models\Teacher;
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
    protected $namespace = 'App\\Http\\Controllers';
    protected $generated_namespace = 'App\\Http\\Controllers\\Generated';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        Route::bind('trashed_admin', function ($id) {
            return Admin::onlyTrashed()->find($id);
        });
        Route::bind('trashed_teacher', function ($id) {
            return Teacher::onlyTrashed()->find($id);
        });
        Route::bind('trashed_student', function ($id) {
            return Student::onlyTrashed()->find($id);
        });
        Route::bind('trashed_family', function ($id) {
            return Family::onlyTrashed()->find($id);
        });
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::prefix('api')
                ->middleware(['api', 'auth:sanctum','userTypeIs:admin'])
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            Route::prefix('api/generated')
                ->middleware(['api', 'auth:sanctum'])
                ->namespace($this->generated_namespace)
                ->group(base_path('routes/generated/generated.php'));

            Route::prefix('api/tcp')
                ->middleware(['api', 'auth:sanctum','userTypeIs:teacher'])
                ->namespace($this->namespace)
                ->group(base_path('routes/tcp.php'));

            Route::prefix('api/scp')
                ->middleware(['api', 'auth:sanctum','userTypeIs:student'])
                ->namespace($this->namespace)
                ->group(base_path('routes/scp.php'));

            Route::prefix('api/fcp')
                ->middleware(['api', 'auth:sanctum','userTypeIs:family'])
                ->namespace($this->namespace)
                ->group(base_path('routes/fcp.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
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
}
