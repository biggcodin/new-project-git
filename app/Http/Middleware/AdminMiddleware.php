<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'برای دسترسی به پنل مدیریت ابتدا وارد شوید.');
        }

        if (!auth()->user()->isAdmin()) {
            abort(403, 'شما دسترسی لازم برای مشاهده این صفحه را ندارید.');
        }

        return $next($request);
    }
}