<?php

namespace App\Http\Middleware;

use App\Config;
use Closure;
use Illuminate\Support\Facades\Redirect;

class VeriryCompetitionStatus
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
    	if (Config::KeyValue('is_continued')->value != true){
    		return Redirect('error.custom')->with('message', '财年暂停中，操作不能进行');
	    }
        return $next($request);
    }
}
