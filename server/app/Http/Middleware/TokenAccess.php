<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Utils\Token;

class TokenAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $token = new Token();
        
        $token_access = $request -> header('Token-Access');

        if (empty($token_access)) {
            return response() -> json([
                'Error' => 'Token not found or does not exist'
            ], 401);
        }

        if ( empty($token::desencrypt($token_access)['name']) ) {
            return response() -> json([
                'Error' => 'Token not valid'
            ], 401);
        }

        if ($token::isExpired()) {
            return response() -> json([
                'Error' => 'Token expired'
            ], 401);
        }

        return $next($request);
    }
}
