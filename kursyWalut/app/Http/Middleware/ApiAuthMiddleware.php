<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ApiAuthMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        $this->checkForToken($request);
        $user = JWTAuth::parseToken()->authenticate();
        $request->auth = $user;
        return $next($request);
    }

    protected function checkForToken($request)
    {
        if (!$this->getToken($request)) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
    }

    protected function getToken($request)
    {
        $header = $request->header('
