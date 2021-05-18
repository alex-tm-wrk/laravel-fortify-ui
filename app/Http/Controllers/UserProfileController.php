<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;

class UserProfileController extends Controller
{
    public function show(Request $request): View
    {
        return view('profile.show', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

    public function profileInformationUpdate(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required'],
                'email' => ['required'],
            ]
        );

        User::find(auth()->user()->id)->update(
            [
                'name' => $request->name,
                'email' => $request->email
            ]
        );

        return redirect()->route('profile.show')->with('profile_updated', 'Profile updated!');
    }

    public function passwordUpdate(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
                               'password' => 'required',
                               'newPassword' => 'confirmed|different:password',
                           ]);
        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                            'password' => Hash::make($request->newPassword)
                        ])->save();

				return redirect()->route('profile.show')->with('password_changed', 'Password changed');
        } else {
				return redirect()->route('profile.show')->with('password_dont_changed', 'Password does not match');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (Hash::check($request->confirm_password, $user->password)) {

            Auth::logout();

            if ($user->delete()) {
                return redirect()->route('home')->with('success', 'Your account has been deleted!');
            }

            return redirect()->route('profile.show')->with('wrong_password', 'error');

        } else {
            return redirect()->route('profile.show')->with('wrong_password', 'Password does not match');
        }
    }
}
