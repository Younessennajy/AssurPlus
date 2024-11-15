<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'can_import' => false, // Par défaut à false
            'can_export' => false, // Par défaut à false
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }
    
    public function updatePermissions(Request $request)
    {
        $userId = $request->input('user_id');
        $permissions = $request->input('permissions', []);
        
        $user = User::findOrFail($userId);
        
        $user->update([
            'can_export' => isset($permissions['export']),
            'can_import' => isset($permissions['import'])
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'Permissions updated successfully');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Méthode pour mettre à jour les informations de l'utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    // Méthode pour supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);  
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

   
}
