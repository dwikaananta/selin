<?php

use App\Http\Controllers\DanaPuniaController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\UpacaraController;
use App\Http\Controllers\UrunanController;
use App\Http\Controllers\UrunanUserController;
use App\Http\Controllers\UserController;
use App\Models\Upacara;
use App\Models\Urunan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $title = 'Home';
    $upacara = Upacara::latest()->get();
    return view('welcome', compact('title', 'upacara'));
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        $users = User::count();

        if ($users < 1) {
            User::create([
                'nama' => 'admin',
                'email' => 'admin',
                'no_hp' => 'admin',
                'jenis_kelamin' => 9,
                'tempat_lahir' => 'admin',
                'tanggal_lahir' => '2001-01-01',
                'kk' => 'admin',
                'status_kk' => 9,
                'alamat' => 'admin',
                'status' => 9,
                'password' => Hash::make('Admin123'),
            ]);
        }

        return view('login', ['title' => 'Home']);
    })->name('login');
    Route::post('/login', function (Request $req) {
        $credentials = $req->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    });
});

Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class);

    Route::resource('/upacara', UpacaraController::class);
    Route::resource('/dana-punia', DanaPuniaController::class);
    Route::resource('/kas-keluar', KasKeluarController::class);

    Route::resource('/urunan', UrunanController::class);
    Route::resource('/urunan-user', UrunanUserController::class);

    Route::get('/wa-sekretaris', function() {
        return response()->json([
            'user' => User::where('status', 2)->first(),
        ]);
    });

    Route::get('/logout', function (Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/login');
    });
});

foreach (glob(__DIR__."/webs/*.php") as $filename)
{
    include $filename;
}