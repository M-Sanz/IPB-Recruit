<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }
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
        return redirect('/login')->with('success', 'Registration Successful! Please Login');
    }
    public function storeOrganisasi(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:4', 'max:30', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'Organisasi';
        $validatedData['active'] = false;
        User::create($validatedData);

        // $request->session()->flash('success', 'Registration Successful! Please Login');
        return redirect('/login')->with('success', 'Registration Successful! Please Wait Until Your Account has been Activated');
    }

    public function mahasiswa()
    {
        return view('register.mahasiswa.index', [
            'title' => 'Registrasi Mahasiswa',
            'active' => 'register'
        ]);
    }

    public function organisasi()
    {
        return view('register.organisasi.index', [
            'title' => 'Registrasi Organisasi',
            'active' => 'register'
        ]);
    }
}
