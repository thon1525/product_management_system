<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;


class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        // return    $customers;
        return Inertia::render('Admin/ManageUser', [
            'customers' =>  $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddUser');
    }

    public function create_edit($id){
        $user = User::findOrFail($id);
        return Inertia::render('Admin/EditUser', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' =>  $request->role,
        ]);

        event(new Registered($user));

        return redirect()
        ->route('user.dashboard.management.create')
        ->with('success', 'Customer successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,customer',
        ]);

        // Find the user and update
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'role'));
        // Redirect with success message
      return redirect()->route('user.dashboard.management')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
