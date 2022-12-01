<?php

use App\Http\Controllers\API\OrganisasiController;
use App\Models\Post;
use App\Models\Form;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\DashboardPostController;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardUserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        'active' => 'beranda'
    ]);
});

Route::get('/konfirmasi', [KonfirmasiController::class, 'index']);
Route::get('konfirmasi/{form:id}', [KonfirmasiController::class, 'show']);
Route::put('/konfirmasi/accept/{form:id}', [KonfirmasiController::class, 'accept']);
Route::put('/konfirmasi/reject/{form:id}', [KonfirmasiController::class, 'reject']);
Route::put('/konfirmasi/organisasi/accept/{user:id}', [KonfirmasiController::class, 'acceptOrganization'])->middleware('is_admin');
Route::delete('/konfirmasi/organisasi/reject/{user:id}', [KonfirmasiController::class, 'rejectOrganization'])->middleware('is_admin');

Route::get('/organisasi', [PostController::class, 'index']);
//Halaman Single Post
Route::get("/organisasi/{post:slug}", [PostController::class, 'show']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);



Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register/mahasiswa', [RegisterController::class, 'store']);
Route::post('/register/organisasi', [RegisterController::class, 'storeOrganisasi']);
Route::get('register/mahasiswa', [RegisterController::class, 'mahasiswa'])->middleware('guest');
Route::get('register/organisasi', [RegisterController::class, 'organisasi'])->middleware('guest');


Route::get('/dashboard/', function () {
    return view('dashboard.index');
})->middleware('auth');
Route::get('/dashboard/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::put('/dashboard/profile/general', [ProfileController::class, 'general'])->middleware('auth');
Route::put('/dashboard/profile/password', [ProfileController::class, 'password'])->middleware('auth');

Route::get('/{post:slug}/daftar', [DaftarController::class, 'index'])->middleware('auth')->middleware('is_student');
Route::post('/{post:slug}/daftar', [DaftarController::class, 'store'])->middleware('auth')->middleware('is_student');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('is_organization');

Route::resource('/dashboard/users', DashboardUserController::class)->middleware('is_admin');
Route::put('/dashboard/admin/password/{user:id}', [DashboardUserController::class, 'password'])->middleware('is_admin');

Route::get('/dashboard/organization', function () {
    return view('dashboard.organizations.index', [
        'users' => User::where('role', 'organisasi')->get()
    ]);
})->middleware('is_admin');
Route::get('/dashboard/organization/{user:id}', function (User $user) {
    return view('dashboard.organizations.show', [
        'user' => $user
    ]);
})->middleware('is_admin');
Route::get('/dashboard/organization/{user:id}/edit', function (User $user) {
    return view('dashboard.organizations.edit', [
        'user' => $user
    ]);
})->middleware('is_admin');
Route::put('/dashboard/organization/{user:id}', function (User $user, Request $request) {
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
    return redirect('/dashboard/organization')->with('success', 'Data berhasil disimpan');
})->middleware('is_admin');
Route::put("/dashboard/organization/password/{user:id}", function (User $user, Request $request) {

    $validatedData = $request->validate([
        'current' => 'required|min:5|max:255',
        'new' => 'required|min:5|max:255',
        're' => 'required|min:5|max:255'
    ]);
    if (password_verify($request->current, $user->password)) {
    } else return redirect('/dashboard/organization/' . $user->id . '/edit')->with('incorrect', 'Password yang anda masukkan salah');

    if ($request->new === $request->re) {
    } else
        return back()->with('different', 'Password yang anda masukkan berbeda');
    $validatedData['new'] = Hash::make($validatedData['new']);
    User::where('id', $user->id)->update(['password' => $validatedData['new']]);
    return redirect('/dashboard/users/' . $user->id)->with('passchanged', 'Password berhasil diubah');
})->middleware('is_admin');
Route::delete("/dashboard/organization/{user:id}", function (User $user, Request $request) {
    if (Post::where('user_id', $user->id)->count() > 0) {
        $posts = Post::where('user_id', $user->id)->get();

        foreach ($posts as $post) {
            $posts_id[] = $post->id;
        }

        if (Form::whereIn('post_id', $posts_id)->count() > 0) {
            Form::whereIn('post_id', $posts_id)->delete();
        }

        Post::where('user_id', $user->id)->delete();
    }
    User::destroy($user->id);
    return redirect('/dashboard/organization')->with('success', 'User berhasil dihapus');
})->middleware('is_admin');
Route::get("/dashboard/organizations/create", function () {

    return view('dashboard.organizations.create');
});
Route::post('/dashboard/organization', function (Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'username' => ['required', 'min:4', 'max:30', 'unique:users'],
        'email' => 'required|email:dns|unique:users',
        'password' => 'required|min:5|max:255'
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);
    $validatedData['role'] = 'Organisasi';
    $validatedData['active'] = true;

    User::create($validatedData);

    // $request->session()->flash('success', 'Registration Successful! Please Login');
    return redirect('/dashboard/organization')->with('success', 'Organisasi berhasil ditambahkan');
})->middleware('is_admin');
