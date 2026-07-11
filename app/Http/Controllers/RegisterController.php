<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard'; // <--- ADD THIS LINE MANUALLY

    public static function middleware(): array
    {
        return [
            new Middleware('guest'),
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) 
    {
        // 1. Set a default image in case no photo is uploaded
        $photo = 'default.jpg'; 

        // 2. Check if a profile photo was uploaded in the request
        if (isset($data['profile_photo'])) {
            // 3. Store the file in the 'profile_photos' folder within the 'public' disk
            $photo = $data['profile_photo']->store('profile_photos', 'public'); 
        }

        // 4. Create the User record in the database
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'daily_calorie_goal' => $data['daily_calorie_goal'] ?? 2000,
            'health_grade' => 'A',
            'profile_photo'      => $photo,
        ]);
    }
}