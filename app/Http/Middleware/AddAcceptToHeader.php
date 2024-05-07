<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Add accept to header
 * the sanctum middleware
 */
class AddAcceptToHeader
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('*api*')) {
            $request->headers->set('Accept', 'application/json');
        }
        
        return $next($request);
    }
}