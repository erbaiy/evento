<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $searchTerm = "invalide";
        $events = Event::where('status', 'like', '%' . $searchTerm . '%')->get();
        return view('back-office.events.handelEvents', compact('events'));
    }
    public function action(Request $request)
    {

        if ($request->valide) {
            $events = Event::find($request->id);
            $events->status = $request->valide;
            $events->update();
            return redirect()->back();
        } else {
            $events = Event::find($request->id);
            $events->delete();
            return redirect()->back();
        }
    }




    // USER CRUD
    public function getAllUser()
    {
        $users = DB::table('users')->get();
        return view('back-office.users.index', compact('users'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
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
            'role' => $request->role,
        ]);
        return redirect()->back();
    }
    public function destroy($id)
    {

        $user = User::findOrFail($id); // Find the user by ID or throw an exception if not found

        if ($user->delete()) {
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the user.');
        }
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
            'role' => 'required',
        ], [
            'email.unique' => 'The email address is already registered.',
        ]);
        dd($id);

        $user = User::findOrFail($id); // Find the user by ID or throw an exception if not found
        $user->update($data);

        if ($user) {
            dd('success', 'User updated successfully.');
            return redirect()->back()->with('success', 'User updated successfully.');
        } else {
            dd('eroor');
            return redirect()->back()->with('error', 'Failed to update the user.');
        }
    }
}
