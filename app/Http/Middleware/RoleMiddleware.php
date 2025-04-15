<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
  public function handle(Request $request, Closure $next, string $role)
  {
    if (!$request->user() || !$request->user()->hasRole($role)) {
      abort(Response::HTTP_FORBIDDEN, 'Unauthorized action.');
    }
    return $next($request);
  }
}
