<?php
namespace App\Auth;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class CustomGuard implements Guard
{
    use GuardHelpers;
    private Request $request;

    public function __construct(
        UserProvider $provider,
        Request $request
    ) {
        $this->request = $request;
        $this->provider = $provider;
    }

    public function attempt(array $credentials)
    {
        dd($this->provider->retrieveByCredentials($credentials));
    }

    public function user()
    {

    }

    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }
}
