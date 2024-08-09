<?php
namespace App\Auth;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Throwable;

class CustomGuard implements Guard
{
    use GuardHelpers;
    private Request $request;

    /**
     * @param CustomProvider $provider
    */
    protected $provider;
    private ?string $token;

    public function __construct(
        UserProvider $provider,
        Request $request // add token for authentication
    ) {
        $this->request = $request;
        $this->provider = $provider;
        $this->token = $this->request->get('token');
    }

    public function attempt()
    {
        if ($this->token) {
            try {
                $info = json_decode(Crypt::decrypt($this->token), true);
                $this->user = $this->provider->retrieveByCredentials($info);

                if ($this->user) {
                    return Cache::remember(md5($this->token), 5,function () {
                        return $this->user;
                    });
                }
            } catch (Throwable $e) {
                return null;
            }
        }

        return null;
    }

    public function user()
    {
        return Cache::get(md5($this->token));
    }

    public function validate(array $credentials = [])
    {
        Log::info('Start Validation');
        // TODO: Implement validate() method.
    }
}
