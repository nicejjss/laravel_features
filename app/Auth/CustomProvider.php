<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Database\Eloquent\Model;

class CustomProvider implements UserProvider
{
    private Model|string $model;

    public function __construct(string $model)
    {
        $this->model = $model;
        $this->createModel();
    }

    private function createModel()
    {
        $class = '\\'.ltrim($this->model, '\\');

        return $this->model = new $class;
    }

    public function retrieveById($identifier)
    {
         return $this->model->where('id', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        return $this->model->where($credentials)->dd()->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }
}
