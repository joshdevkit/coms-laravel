<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class AccountSettingsController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile.account-settings', compact('user'));
    }


    public function update(Request $request)
    {
        $userDetails = Auth::user()->id;
        $user = User::findOrFail($userDetails);

        $rules = [
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'fullname' => 'required|string|max:255',
            'emailAddress' => 'required|email|max:255',
            'current_password' => 'nullable|string|min:8|confirmed|required_with:confirm_password',
        ];

        if ($request->filled('current_password')) {
            $rules['current_password'] = [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!password_verify($value, $user->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->fullname = $request->input('fullname');
        $user->email = $request->input('emailAddress');

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        if ($request->hasFile('avatar')) {
            $avatarExtension = $request->file('avatar')->getClientOriginalExtension();
            $avatarFileName = 'avatar_' . $user->id . '.' . $avatarExtension;
            $request->file('avatar')->move(public_path('avatars'), $avatarFileName);
            $user->update(['avatar' => 'avatars/' . $avatarFileName]);
        }

        $user->save();

        return redirect()->back()->with('success', 'Account updated successfully');
    }


    public function update_once()
    {
        $user = Auth::user();

        if($user->type === 2)
        {
            return view('manager.password.update-password', compact('user'));
        }
        else if($user->type === 3)
        {
            return view('member.password.update-password', compact('user'));
        }
        else if($user->type === 0)
        {
            return view('owner.password.update-password', compact('user'));
        }
    }

    public function update_password(Request $request)
    {
        $userDetails = Auth::user()->id;
        $user = User::findOrFail($userDetails);

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->is_activated = 1;
        $user->save();

        if($user->type === 2)
        {
            return redirect()->route('manager.dashboard');
        }
        else if($user->type === 3)
        {
            return redirect()->route('member.dashboard');
        }
        else if($user->type === 0)
        {
            return redirect()->route('owner.dashboard');
        }
    }


    public function change()
    {
        $userDetails = Auth::user()->id;
        $user = User::findOrFail($userDetails);
        if($user->type === 0)
        {
            return view('owner.password.change-password');
        }
        else if($user->type === 3)
        {
            return view('member.password.change-password');
        }
        else if($user->type === 2)
        {
            return view('manager.password.change-password');
        }
    }

    public function update_change(Request $request)
    {
        $userDetails = Auth::user()->id;
        $user = User::findOrFail($userDetails);

        $rules = [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required_with:current_password|string|min:8|confirmed',
            'new_password_confirmation' => 'required'
        ];

        if ($request->filled('new_password')) {
            $rules['new_password_confirmation'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (password_verify($request->input('current_password'), $user->password)) {
            if ($request->filled('new_password')) {
                $otp =  $user->remember_token = Str::random(60);
                session(['new_password' => Hash::make($request->input('new_password'))]);
            }
            Mail::to($user->email)->send(new OtpMail($user, $otp));
            $user->save();
            session(['isOTP' => true]);
            return redirect()->back()->with('success', 'OTP is Required Upon changing the Password');
        }

        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])
            ->withInput();
    }


    public function verify_otp(Request $request)
    {
        $userDetails = Auth::user()->id;
        $user = User::findOrFail($userDetails);

        $rules = [
            'otp_value' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('otp_value') === $user->remember_token) {
            $newPassword = session('new_password');
            $otp = session('otp');
            session()->forget(['new_password', 'isOTP']);

            $user->password = $newPassword;
            $user->save();

            return redirect()->back()->with('success', 'Password Updated Successfully');
        }

        if($user->type === 0)
        {
            return view('owner.password.change-password');
        }
        else if($user->type === 3)
        {
            return view('member.password.change-password');
        }
        else if($user->type === 2)
        {
            return view('manager.password.change-password');
        }
    }
}
