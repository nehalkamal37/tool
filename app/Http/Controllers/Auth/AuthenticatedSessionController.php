<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Authenticate the user
    $request->authenticate();

    // Regenerate session to prevent session fixation
    $request->session()->regenerate();

    // Retrieve the authenticated user
    $user = auth()->user(); // Fetch the authenticated user

//dd($user->role);
    // Ensure the user exists and has a role
    if ($user && $user->role) {
        switch ($user->role) {
            case 'pharmacist':
                return redirect()->route('tool'); // Fallback route

              //  return redirect()->route('pharmacist.dashboard');
            case 'administrator':
                return redirect()->route('dash');
                case 'manager':
                    return redirect()->route('dash');
            default:
                return redirect()->route('tool'); // Fallback route
        }
    }

    // If the user or role is not defined, fallback to home
    return redirect()->route('tool');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
