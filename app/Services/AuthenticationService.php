<?php
namespace App\Services;

use App\Jobs\MailVerification;
use App\Models\User;
use App\Repositories\AuthenticationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthenticationService
{

    protected $authenticationRepo, $user;

    public function __construct(AuthenticationRepository $authenticationRepo, User $user)
    {
        $this->authenticationRepo = $authenticationRepo;
        $this->user               = $user;
    }

    public function create($data)
    {

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Ensure 6-digit OTP

        try {

            $userData = [
                'username' => $data->username,
                'email'    => $data->email,
                'password' => Hash::make($data->password), // Securely hash the password
                'address'  => $data->address,
            ];

            // Save the user and OTP
            $this->authenticationRepo->create($userData, $otp);

            // Dispatch the email verification job
            MailVerification::dispatch($userData['username'], $userData['email'], $otp);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in OTP generation or email dispatch: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }

        return $userData; // Return non-sensitive data
    }

    public function LoginRequest($data)
    {

        // Get credentials from the request
        $credentials = $data->only('email', 'password');

        // Attempt to log in with the provided credentials
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Get the authenticated user
            $id   = Auth::id();

            // Store the username in the session
            $data->session()->put('username', $user->username);

            // Handle 'remember me' functionality
            if ($data->filled('remember')) {
                Auth::login($user, true); // Remember the user
            } else {
                Auth::login($user); // Log in without remembering
            }

            // Generate a token for the authenticated user
            $user  = User::find($id);
            $token = $user->createToken('web-session')->plainTextToken;

            // Redirect to the questions route with a success message and token

            return redirect()->route('questions')->with(['success' => 'Logged in successfully.', 'token' => $token]);
        } else {
            // Return back with an error if login fails
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

}
