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
        $token_access = $request -> post('token_access');

        if (empty($token_access)) {
            return response() -> json([
                'Error' => 'Token not found or does not exist'
            ], 401);
        }

        if ( empty( Token::desencrypt($token_access)['email'] ) ) {
            return response() -> json([
                'Error' => 'Token not valid'
            ], 401);
        }
    }
}
