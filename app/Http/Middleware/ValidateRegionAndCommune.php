<?php

namespace App\Http\Middleware;

use App\Models\Commune;
use App\Models\Region;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateRegionAndCommune
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $region  = Region::findOrFail($request->input("region_id"), ['id']);
        $commune = Commune::where(["commune_id" => $request->input("commune_id"), "region_id" => $region->id])->firstOrFail();
            
        return $next($request);
    }
}
