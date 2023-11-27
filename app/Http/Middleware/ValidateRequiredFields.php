<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateRequiredFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            "dni"        => "required|string|min:1|max:45",
            "region_id"  => "required|numeric",
            "commune_id" => "required|numeric",
            "email"      => "required|email|max:120",
            "name"       => "required|string|min:2|max:45",
            "last_name"  => "required|string|min:2|max:45",
            "address"    => "string|max:255",
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "error" => $validator->errors()->all(),
            ], 400);
        }
            
        return $next($request);
    }
}
