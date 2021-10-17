<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsWorker
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
        if(auth()->user()->userable_type == 'App\Models\Worker'){
            return $next($request);
        }

        return redirect('/')->with('error',"You don't have worker access.");
    }
}
