<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthentificationController extends Controller
{

    public function getSignUpView()
    {

        return view('auth.sign-up');
    }

    public function register(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.unique' => 'The email address is already registered.',
        ]);


        $isEmailExist = User::where('email', $request->email)->first();

        if ($isEmailExist) {
            return back()->withErrors(['email' => 'The email address is already registered.'])->withInput();
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('getSignInView');
    }
    public function getSignInView()
    {
        return view('auth.sign-in');
    }



    public  function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->first();        // dd($user);

        if (!$user || !Hash::check($request->password, $user->password)) {

            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        } else {
            session(['id' => $user->id]);
            session('id');
            echo '<h1 class="alert alert-danger"> welcome in home page</h1>';
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('success', 'Vous avez été déconnecté avec succès.');
        return redirect()->route('getSignUpView');
    }
}
