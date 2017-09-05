<?php

namespace App\Http\Middleware;

use Closure;
use App\Config;

class VerifyRegister
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
		if (Config::KeyValue('is_able_to_register')->value == false) {
			return Redirect('error')->with('message', '注册被停用');
		}

		return $next($request);
	}
}
