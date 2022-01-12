<?php

namespace App\Http\Middleware;

use App\Helpers\AuthCommon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RyunaRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            if(in_array('member', $roles)){
                return redirect('/member/login');
            }else{
                return redirect('/admin/login');
            }
        }

        $user = AuthCommon::user();

        if(in_array($user->role->role, $roles)){        
            return $next($request);
        }
        return $next($request);
        
        // abort(403);
    }
}
