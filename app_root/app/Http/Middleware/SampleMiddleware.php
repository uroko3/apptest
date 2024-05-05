<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Soyama;
use Illuminate\Http\Request;
use Log;

class SampleMiddleware
{
	private $s;
	
	public function __construct(Soyama $s) {
		$s = $this->s;
	}
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
    	Log::info('call SampleMiddleware');
    	
        return $next($request);
    }
}
