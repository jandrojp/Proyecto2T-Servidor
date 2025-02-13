<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Usuario eliminado correctamente.');
    }


    public function showRegisterForm()
    {
        return view('admin.register'); 
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,client',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], 
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuario añadido correctamente.');
    }


    public function showUpdateForm()
    {
        return view('admin.update'); 
    }

    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'search_email' => 'required|string|email|exists:users,email',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,client',
        ]);

        $user = User::where('email', $validated['search_email'])->first();

        if ($user) {
            $user->name = $validated['name'];
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }
            $user->role = $validated['role'];
        
            $user->save();
            return redirect()->route('admin.dashboard')->with('success', 'Usuario actualizado correctamente.');
        }

        return back()->withErrors(['search_email' => 'No se encontró ningún usuario con ese correo electrónico.']);
    }
 
}
