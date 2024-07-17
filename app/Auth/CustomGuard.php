<?php
namespace App\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class CustomGuard implements Guard
{
    protected UserProvider $provider;
    private Request $request;

    public function __construct(UserProvider $provider)
    {
        $this->provider = $provider;
    }

    public function check(array $credentials = [])
    {
        dd($this->provider->retrieveByCredentials($credentials));
        // TODO: Implement check() method.
    }

    public function guest()
    {
        // TODO: Implement guest() method.
    }

    public function user()
    {
        // TODO: Implement user() method.
    }

    public function id()
    {
        // TODO: Implement id() method.
    }

    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }

    public function hasUser()
    {
        // TODO: Implement hasUser() method.
    }

    public function setUser(\Illuminate\Contracts\Auth\Authenticatable $user)
    {
        // TODO: Implement setUser() method.
    }
}
