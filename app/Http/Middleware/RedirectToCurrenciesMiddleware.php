<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToCurrenciesMiddleware {
    
    public function handle($request, Closure $next) {

        if ($request->is('admin')) {

            return redirect('admin/currencies');

        }
        
        return $next($request);
    }

}