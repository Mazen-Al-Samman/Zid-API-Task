<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserHasStore
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty(auth()->user()->store)) return $next($request);
        return response()->json([
            "error" => "There is no store linked to your account!"
        ], ResponseAlias::HTTP_FORBIDDEN);
    }
}
