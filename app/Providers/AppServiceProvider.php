<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Notifications\CustomVerifyEmail;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\ForzarCambioClave;
use App\Http\Middleware\EnsureEmailIsVerifiedSegunRol;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ Registrar todos los middlewares personalizados
        Route::aliasMiddleware('checkRole', CheckRole::class);
        Route::aliasMiddleware('verified.custom', EnsureEmailIsVerifiedSegunRol::class);
        Route::aliasMiddleware('forzar.clave', ForzarCambioClave::class);

        // ✅ (Opcional) Ruta de prueba si aún la necesitas
        Route::middleware('web')
            ->group(function () {
                Route::get('/admin', function () {
                    return 'Bienvenido Admin';
                })->middleware(['auth', 'checkRole:admin']);
            });

        // ✅ Personalizar el email de verificación
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return new CustomVerifyEmail($url, $notifiable);
        });
    }

    public const HOME = '/';
}
