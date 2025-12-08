<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthManager extends Controller
{
//    through sociallite wee are using the googledrive > redirect to the google screen

    function login()
    {
        return view('login');
    }

    function register()
    {
        return view('registration');
    }

    function adminView()
    {
        return view('Admin.admin_home');
    }

    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;

        $user = User::create($data);
        if (!$user) {
            return redirect(route('registration'))->with("error", "Registration failed");
        }
        return redirect(route('login'))->with("success", "Registration successfull");
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-captcha-response' => 'captcha',
        ]);

        $credentials = $request->only('email', 'password');
         // This is the credentials for the user
        $adminCredentials = [
            'email' => 'farheen@gmail.com',
            'password' => 'abc.123',
        ];

        if ($request->email === $adminCredentials['email'] & $request->password === $adminCredentials['password']){
        Auth::loginUsingId(2);
        return redirect()->route('admin.home');
    }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('welcome');
        }
        return redirect(route('login'))->with("error", "Login failed");
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'))->with("success", "Logged out successfully");
    }
    // 1) Redirect user to Google
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2) Handle callback from Google
    public function googleCallback()
    {
        try {
//            the input details from the login with google with be stored in this
            $googleUser = Socialite::driver('google')->user();

            // Find existing user OR create new one. This 'email' is of our database
            $user = User::where('email', $googleUser->getEmail())->first();

            if (! $user) {
                $user = User::create([
//                    The below are the names of the column
                    'name'              => $googleUser->getName(),
                    'email'             => $googleUser->getEmail(),
                    'password'          => bcrypt(Str::random(16)), // random password of the length
                    'email_verified_at' => now(), // optional, this brings the current timestamp
                    // 'role'           => 'user', // if you have roles
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect based on role if you want
            // if ($user->role === 'admin') {
            //     return redirect()->route('admin.dashboard');
            // }

            return redirect()->route('dashboard'); // or home page

        } catch (\Exception $e) { // we have used try catch that handles the login with google
            // You can dd($e->getMessage()) while testing
            return redirect()->route('login')->with('error', 'Something went wrong with Google login.');
        }
    }

}
//    through socialite wee are using the googledrive > redirect to the google screen

