<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        \Log::info("===================CustomAuthentication=================");
        //Mocking authenticated user list without database
        $authenticatedUsers = array([
            'codewithgun' => 'gunwithpassword'
        ]);

        $authenticatedUsers = array(
            'codewithgun' => 'gunwithcode'
        );

        $user = $request->header('user');
        $password = $request->header('password');
        if (!array_key_exists($user, $authenticatedUsers)) {
            return response('Unauthorized', 401);
        }
        if ($authenticatedUsers[$user] != $password) {
            return response('Unauthorized', 401);
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
