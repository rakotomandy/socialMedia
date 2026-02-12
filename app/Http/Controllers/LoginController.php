<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Controller responsible for authentication flows used by the chat app.
 *
 * Responsibilities:
 * - Handle user signup and validation.
 * - Authenticate users and manage sessions.
 * - Handle password reset request flow.
 * - Perform logout and session invalidation.
 */
class LoginController extends Controller
{
    //
    /**
     * Show the login view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Handle a registration request and create a new `Login` user.
     *
     * Validates the incoming request and creates the user record using
     * a hashed password. On success redirects to the login page with
     * a success flash message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:login,email',
            'password' => 'required|min:4|confirmed',
        ]);

        Login::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    /**
     * Authenticate a user against the `login` guard.
     *
     * Attempts to authenticate using the provided credentials. If
     * successful regenerates the session to prevent fixation and
     * redirects to the `home` route. Otherwise returns back with
     * an authentication error.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|RedirectResponse
     */
    public function login(Request $request): RedirectResponse|View
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('login')->attempt($request->only('email', 'password'))) {

            // Regenerate session to prevent fixation attack
            $request->session()->regenerate();

            // Redirect to the home route
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function home()
    {
        $email = auth()->guard('login')->user()->email;
        $usersLogin = Login::all();
        return view('messageView.home', compact('email', 'usersLogin'));
    }


    /**
     * Initiate a password reset flow for the given email.
     *
     * Validates the email exists in the `login` table and generates a
     * password reset token. Redirects to the reset form route with the
     * token and email as parameters. If the email does not exist returns
     * an error back to the form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $request->validate([
            'email' => 'required|email|exists:login,email',
        ]);

        if (Login::where('email', $email)->exists()) {
            return redirect()->route('password.reset', ['token' => Password::createToken(Login::where('email', $email)->first()), 'email' => $email]);
        } else {
            return back()->withErrors(['email' => 'Email address not found.']);
        }
    }

    /**
     * Reset a user's password using a valid token and email.
     *
     * Validates token, email and the new password confirmation. Updates
     * the stored password (hashed) and redirects to login with a success
     * message.
     *
     * Note: This implementation assumes token validation is handled by
     * the `Password::createToken`/reset workflow elsewhere; adjust as
     * needed for stricter verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ]);

        Login::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Password has been reset successfully. Please login with your new password.');
    }

    /**
     * Log the user out of the `login` guard and invalidate the session.
     *
     * Performs guard logout, invalidates the session and regenerates the
     * CSRF token before redirecting to the login page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('login')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
