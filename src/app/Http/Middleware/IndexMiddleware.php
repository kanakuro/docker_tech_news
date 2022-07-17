<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IndexMiddleware
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
        if(session('user_id', 99) === 99){
            $create_user = 0;
            $errmessage = 'ログアウトされました。ログインし直してください。';
            $param = [
                'create_user' => $create_user,
                'errmessage' => $errmessage
            ];
            $request->session()->invalidate();
            return redirect()->action([LoginController::class, 'getLogin'], $param);
        }

        return $next($request);
    }
}
