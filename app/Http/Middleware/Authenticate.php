<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if ($this->auth->guard($guard)->guest()) {
        //     return response('Unauthorized.', 401);
        // }

        $keys = "plain-text";
        $response = $next($request);
        // Check the header of JSON request of the API
        if(Hash::check($keys, $request->header('authentication'))){
            return $response;
        }
        // If the token is false, return error response in JSON format
        return response()->json(['code' => 0, 'message' => 'Invalid Authentication or Credentials']);
    }
}
