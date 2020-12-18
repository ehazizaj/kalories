<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->isAdmin == 1) {
            return $next($request);
        }

        //return redirect('/')->with('error','You are not allowed to perform this action');
        //return redirect()->back()->getTargetUrl()->with('error','You are not allowed to perform this action')
        //return Redirect::back()->with(['error', 'You are not allowed to perform this action']);
        return Redirect::back()->with('error', 'You are not allowed to perform this action');
    }
}
