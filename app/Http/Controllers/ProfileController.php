<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index', [
            'user' => User::where('id', auth()->user()->id)->get()
        ]);
    }
    public function general(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255'
        ];
        if ($request->email != auth()->user()->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }
        if ($request->username != auth()->user()->username) {
            $rules['username'] = 'required|min:4|max:30|unique:users';
        }
        $validated_data = $request->validate($rules);

        User::where('id', auth()->user()->id)->update($validated_data);
        return redirect('/dashboard/')->with('success', 'Data berhasil disimpan');
    }
    public function password(Request $request)
    {
        $validatedData = $request->validate([
            'current' => 'required|min:5|max:255',
            'new' => 'required|min:5|max:255',
            're' => 'required|min:5|max:255'
        ]);
        if (password_verify($request->current, auth()->user()->password)) {
        } else return redirect('/dashboard/profile')->with('incorrect', 'Password yang anda masukkan salah');

        if ($request->new === $request->re) {
        } else
            return back()->with('different', 'Password yang anda masukkan berbeda');
        $validatedData['new'] = Hash::make($validatedData['new']);
        User::where('id', auth()->user()->id)->update(['password' => $validatedData['new']]);
        return redirect('/dashboard')->with('passchanged', 'Password berhasil diubah');
    }
}
