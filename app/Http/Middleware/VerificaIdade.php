<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificaIdade
{
    public function handle($request, Closure $next)
    {
        if ($request->idade <= 200) {
            return $next($request);
        }

        return redirect('home');
    }
}

