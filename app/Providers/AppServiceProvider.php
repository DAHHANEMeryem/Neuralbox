<?php

namespace App\Providers;

use App\Models\Paiement;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;


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
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $expiresAt = now()->addMinutes(2);
                Cache::put('user-is-online-' . Auth::id(), true, $expiresAt);
            }
        });
        
        Gate::define('see', function (User $user) {
            $paiments = Paiement::where('user_id',$user->id)->andwhere('status','success')->get();
            return (count($paiments) > 0) ;
        });
    }
    public function redirectTo()
{
    $user =Auth::user();

    // Si c’est l’admin avec un email fixe
    if (Auth::user()->is_admin) {
        return '/admin/dashboard';
    }

    // Sinon, utilisateur normal
    return '/dashboard';
}




}
