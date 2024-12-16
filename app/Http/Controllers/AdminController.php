<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    

    
    public function createUser()
    {
        $users = User::all(); // Fetch all readers from the database
        return view('admin.add_reader', compact('users')); // Pass the readers to the view
    }
    

    public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'age' => 'required|integer',
        'gender' => 'required|in:male,female',
        'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'required|string|min:8', // Add password validation
    ]);

    $user = new User();

    // Handle image upload if present
    if ($request->hasFile('profile_photo_path')) {
        $profile_photo_path = $request->file('profile_photo_path');
        $imageName = time() . '.' . $profile_photo_path->getClientOriginalExtension();
        $path = $profile_photo_path->storeAs('readerimage', $imageName, 'public');
        $user->profile_photo_path = $path;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->gender = $request->gender;
    $user->age = $request->age;
    $user->password = bcrypt($request->password); // Hash and save password

    $user->save();

    return redirect()->back()->with('message', 'User added successfully!');
}
    
    
       public function deleteUser($id)
{
    $users = User::findOrFail($id);
    $users->delete();

    return redirect()->back()->with('message', 'Reader deleted successfully!');
}
public function banUser($id)
{
    $users = User::findOrFail($id);
    $users->status = 'banned';
    $users->save();

    return redirect()->back()->with('message', 'Reader banned successfully!');
}

}
