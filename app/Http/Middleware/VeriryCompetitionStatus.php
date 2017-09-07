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
    		return Redirect('error')->with('message', '正在清算当前财年结果，比赛暂停中！');
	    }
        return $next($request);
    }
}
