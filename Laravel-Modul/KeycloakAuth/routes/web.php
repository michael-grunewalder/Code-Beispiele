<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Modules\KeycloakAuth\App\Http\Controllers\KeycloakAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['web']], function () {
    //Route::get('backoffice', Filament\Pages\Auth\Login::class)->name('backup.login');
    Route::get('/auth/redirect',function(){return Socialite::driver('keycloak')
        ->scopes(['openid'])
        ->redirect();})
        ->name('login');//same name as filament login route so it kicks in
    Route::any('/admin/logout', function(){
        Auth::logout();
        // The user will not be redirected back.
        return redirect(Socialite::driver('keycloak')->getLogoutUrl());
    });
    Route::get('/auth/callback',[KeycloakAuthController::class,'callback'])->name('oauth.callback');
    // Route::get('/auth/callback',CallbackController::class)->name('oauth.callback');
    if (!app()->isProduction()) {
        route::get('php', function(){phpinfo();});
    }
});
Route::group([], function () {
    Route::resource('keycloakauth', KeycloakAuthController::class)->names('keycloakauth');
});
