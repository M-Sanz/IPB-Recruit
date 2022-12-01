<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\Form;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::where('role', 'mahasiswa')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:4', 'max:30', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'Mahasiswa';
        $validatedData['active'] = true;

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration Successful! Please Login');
        return redirect('/dashboard/users')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255'
        ];
        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }
        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:4|max:30|unique:users';
        }
        $validated_data = $request->validate($rules);

        User::where('id', $user->id)->update($validated_data);
        return redirect('/dashboard/users')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Form::where('user_id', $user->id)->count() > 0) {
            Form::where('user_id', $user->id)->delete();
        }
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('success', 'User berhasil dihapus');
    }
    public function password(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'current' => 'required|min:5|max:255',
            'new' => 'required|min:5|max:255',
            're' => 'required|min:5|max:255'
        ]);
        if (password_verify($request->current, $user->password)) {
        } else return redirect('/dashboard/users/' . $user->id . '/edit')->with('incorrect', 'Password yang anda masukkan salah');

        if ($request->new === $request->re) {
        } else
            return back()->with('different', 'Password yang anda masukkan berbeda');
        $validatedData['new'] = Hash::make($validatedData['new']);
        User::where('id', $user->id)->update(['password' => $validatedData['new']]);
        return redirect('/dashboard/users/' . $user->id)->with('passchanged', 'Password berhasil diubah');
    }
}
