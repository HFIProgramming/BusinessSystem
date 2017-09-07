<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($request->user()->id !== 1) {
			return Redirect('error')->with('message', '小子你想法不错哦，居然想篡位？？？');
		}

		return $next($request);
	}
}
