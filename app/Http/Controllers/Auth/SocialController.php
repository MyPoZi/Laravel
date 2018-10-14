<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\User;
use App\SocialAccount;

class SocialController extends Controller
{
    protected $redirectTo = '/gists';

    public function getGithubAuth()
    {
        return Socialite::driver('github')->with(['scope' => 'gist'])->redirect();
    }

    public function getGithubAuthCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = $this->createOrGetUser($githubUser, 'github');
        Auth::login($user, true);

        return redirect($this->redirectTo);
    }


    public function createOrGetUser($providerUser, $provider)
    {
        $account = SocialAccount::firstOrCreate([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $provider,
        ]);

        if (empty($account->user)) {
            $user = User::create([
                'name' => $providerUser->getNickname(),
                'email' => $providerUser->getEmail(),
            ]);
            $account->user()->associate($user);
        }

        $account->provider_access_token = $providerUser->token;
        $account->save();

        return $account->user;
    }
}