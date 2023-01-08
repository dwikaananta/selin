<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $jenis_kelamin = [
        1 => 'Laki-laki',
        2 => 'Perempuan',
    ];

    public $status_kk = [
        1 => 'Kepala Keluarga',
        2 => 'Anggota Keluarga',
    ];

    public $status_user = [
        1 => 'Ketua',
        2 => 'Sekretaris',
        3 => 'Anggota',
    ];

    public function index(Request $req)
    {
        if ($req->js) {
            $users = User::noAdmin()
                ->when($req->search, function ($query) use ($req) {
                    return $query->where(function ($query) use ($req) {
                        return $query->where('nama', 'like', "%$req->search%")
                            ->orWhere('email', 'like', "%$req->search%")
                            ->orWhere('no_hp', 'like', "%$req->search%")
                            ->orWhere('tempat_lahir', 'like', "%$req->search%")
                            ->orWhere('tanggal_lahir', 'like', "%$req->search%")
                            ->orWhere('kk', 'like', "%$req->search%")
                            ->orWhere('alamat', 'like', "%$req->search%");
                    });
                })
                ->paginate(env('PAGINATION'));

            $jenis_kelamin = $this->jenis_kelamin;
            $status_kk = $this->status_kk;
            $status_user = $this->status_user;

            return response()->json(compact('users', 'jenis_kelamin', 'status_kk', 'status_user'));
        }

        $title = 'Data User';

        return view('users.users', compact('title'));
    }

    public function create()
    {
        $title = 'Tambah Data User';
        $jenis_kelamin = $this->jenis_kelamin;
        $status_kk = $this->status_kk;
        $status_user = $this->status_user;

        return view('users.create', compact('title', 'jenis_kelamin', 'status_kk', 'status_user'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kk' => 'required|size:16',
            'status_kk' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'password' => 'required',
        ]);

        User::create(array_merge($req->except('password'), ['password' => Hash::make($req->password)]));

        return redirect('/users')->with('success', 'Berhasil tambah data User !');
    }

    public function show(User $user)
    {
        $title = 'Lihat Data User';
        $jenis_kelamin = $this->jenis_kelamin;
        $status_kk = $this->status_kk;
        $status_user = $this->status_user;

        return view('users.show', compact('title', 'user', 'jenis_kelamin', 'status_kk', 'status_user'));
    }

    public function edit(User $user)
    {
        $title = 'Ubah Data User';
        $jenis_kelamin = $this->jenis_kelamin;
        $status_kk = $this->status_kk;
        $status_user = $this->status_user;

        return view('users.edit', compact('title', 'user', 'jenis_kelamin', 'status_kk', 'status_user'));
    }

    public function update(Request $req, User $user)
    {
        $data = $req->validate([
            'nama' => 'required',
            'email' => "required|unique:users,email,$user->id",
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kk' => 'required|size:16',
            'status_kk' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        $user->update($data);

        if ($req->password) {
            $user->update(['password' => Hash::make($req->password)]);
        }

        return redirect('/users')->with('success', 'Berhasil ubah data User !');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['status' => 'success', 'msg' => 'Berhasil hapus data User !']);
    }
}
