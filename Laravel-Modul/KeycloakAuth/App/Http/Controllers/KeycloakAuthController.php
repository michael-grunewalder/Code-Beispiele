<?php

namespace Modules\KeycloakAuth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class KeycloakAuthController extends Controller
{
    public function callback(Request $request): Response|RedirectResponse
    {
        $oAuthUser  =   null;
        try
        {
            $oAuthUser  =   Socialite::driver('keycloak')->user();
            $user       =   User::userFromSso($oAuthUser);
            Auth::login($user);
            return redirect()->intended('/');
        }
        catch(Laravel\Socialite\Two\InvalidStateException $e)
        {
            return Socialite::driver('keycloak')->scopes(['openid'])->redirect();
        }
        catch(\Exception $e) {
            dd("An error occured.",$e);
        }
        //$user = Socialite::driver('keycloak')->user();
        //$request->session()->put('keycloak_user', $user);
        //return redirect()->route('admin.dashboard');
    }
}
