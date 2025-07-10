<?php

namespace App\Http\Middleware;

use App\Filament\Resources\UserVerificationResource;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserVerification; // Import model UserVerification
use Filament\Facades\Filament; // Import Filament Facade

class RestrictUnverifiedUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || $user->hasRole('Super Admin')) {
            return $next($request);
        }
        $verification = $user->userVerification;
        if (!$verification || $verification->status !== 'diterima') {
            $verificationResourceIndexUrl = UserVerificationResource::getUrl('index');
            if (
                $request->fullUrl() === $verificationResourceIndexUrl ||
                $request->routeIs('filament.admin.resources.user-verifications.*') ||
                $request->routeIs('filament.admin.auth.logout')
            ) {
                return $next($request);
            }
            return redirect()->to($verificationResourceIndexUrl);
        }
        return $next($request);
    }
}
