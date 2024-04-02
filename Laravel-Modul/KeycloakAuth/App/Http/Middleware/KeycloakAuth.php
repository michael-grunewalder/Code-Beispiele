<?php

namespace Modules\KeycloakAuth\App\Http\Middleware;

use App\Models\User;
use Closure;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class KeycloakLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('Hey gorgeous, I am in the middleware');
        if (!$token = $request->bearerToken()) {
            \Log::info('MIDDLEWARE: No Bearer Token');
            return Socialite::driver('keycloak')->stateless()->redirect();
        }
        $oAuthUser  =   null;
        try {
            $oAuthUser = Socialite::driver('keycloak')->userFromToken($token);
            //\Log::info('MIDDLEWARE: Token for User',[$oAuthUser]);
        }
        catch(ClientException $exception) {
            return Socialite::driver('keycloak')->stateless()->redirect();
        }
        catch(\Exception $exception) {
            dd(get_class($exception), $exception);
        }
        try {
            $user       =   User::userFromSso($oAuthUser);
            if (!$user->can('login-frontend'))
            {
                return redirect('/');
            }
            Auth::login($user);
        }
        catch(\Laravel\Socialite\Two\InvalidStateException $e) {
            return Socialite::driver('keycloak')->redirect();
        }
        catch(\GuzzleHttp\Exception\ClientException $e) {
            return Socialite::driver('keycloak')->redirect();
        }
        catch (Exception $exception ) {
            dd(get_class($exception), $exception);
        }
        $request->message = 'I am a pain in the arse but you beat me!';
        return $next($request);
    }

}
