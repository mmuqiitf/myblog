<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index(User $user)
    {
        $title = 'Faturrahman Blog - My Profile';
        $categories = Category::orderBy('title', 'ASC')->get();
        if ($user->id != auth()->id()) {
            return redirect()->back();
        }
        return view('frontend.users.index', compact('user', 'title', 'categories'));
    }
    public function update(Request $request, User $user)
    {
        // Get Picture
        $picture = $user->picture;
        if ($request->hasFile('picture')) {
            Storage::delete($user->picture);
            $picture = $request->file('picture')->store('assets/photo-profile');
        }
        // If users don't want to change password
        if (($request->old_password == '') && ($request->password == '')) {
            $this->validate($request, [
                'name' => 'required|min:4',
                'email' => 'required|email',
                'picture' => 'file|image'
            ]);
            // If users want to change email
            if ($user->email != $request->email) {
                $user->update([
                    'name' => $request->name,
                    'email' =>  $request->email,
                    'picture' => $picture,
                    'email_verified_at' => null
                ]);
                return redirect()->back()->with('success', 'Your profile has been updated! Please verify email');
            }
            $user->update([
                'name' => $request->name,
                'email' =>  $request->email,
                'picture' => $picture
            ]);
            return redirect()->back()->with('success', 'Your profile has been updated!');
        }
        // If users want to change password
        else {
            $this->validate($request, [
                'name' => 'required|min:4',
                'email' => 'required|email',
                'old_password' => 'required|min:8',
                'password' => 'required|min:8',
                'picture' => 'file|image'
            ]);
            if (Hash::check($request->old_password, $user->password)) {
                // If users want to change email
                if ($user->email != $request->email) {
                    $user->update([
                        'name' => $request->name,
                        'email' =>  $request->email,
                        'password' => Hash::make($request->password),
                        'picture' => $picture,
                        'email_verified_at' => null
                    ]);
                    return redirect()->back()->with('success', 'Your profile has been updated! Please verify email');
                }
                $user->update([
                    'name' => $request->name,
                    'email' =>  $request->email,
                    'password' => Hash::make($request->password),
                    'picture' => $picture
                ]);
                return redirect()->back()->with('success', 'Your profile has been updated!');
            } else {
                return redirect()->back()->with('danger', 'Password didn\'t match!');
            }
        }
    }
}
