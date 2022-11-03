<?php

namespace App\Http\Controllers;

use App\Models\UrunanUser;
use App\Models\User;
use Illuminate\Http\Request;

class UrunanUserController extends Controller
{
    public $users;

    public function __construct() {
        $this->users = User::noAdmin()->orderBy('nama')->get();
    }

    public function index(Request $req)
    {
        if ($req->js) {
            $urunan_user = UrunanUser::select('*')
                ->where('urunan_id', $req->urunan_id)
                ->when($req->search, function ($query) use ($req) {
                    return $query->where(function ($query) use ($req) {
                        // search
                    });
                })
                ->get();

            $users = $this->users;

            return response()->json(compact('urunan_user', 'users'));
        }
    }

    public function create(Request $req)
    {
        $title = 'Tambah Data Urunan User';
        $urunan_id = $req->urunan_id;
        $users = $this->users;

        return view('urunan_user.create', compact('title', 'urunan_id', 'users'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'urunan_id' => 'required',
            'user_id' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
        ]);

        UrunanUser::create($data);
        
        return redirect("/urunan/$req->urunan_id")->with('success', 'Berhasil tambah data Urunan User !');
    }

    public function show(UrunanUser $urunanUser)
    {
        //
    }

    public function edit(UrunanUser $urunanUser, Request $req)
    {
        $title = 'Ubah Data Urunan user';
        // $urunan_user = UrunanUser::find($id);
        $urunan_user = $urunanUser;
        $urunan_id = $req->urunan_id;
        $users = $this->users;

        return view('urunan_user.edit', compact('title', 'urunan_user', 'urunan_id', 'users'));
    }

    public function update(Request $req, UrunanUser $urunanUser)
    {
        $data = $req->validate([
            'urunan_id' => 'required',
            'user_id' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
        ]);

        $urunanUser->update($data);

        return redirect("/urunan/$req->urunan_id")->with('success', 'Berhasil ubah data Urunan User !');
    }

    public function destroy($id)
    {
        UrunanUser::destroy($id);
        return response()->json(['status' => 'success', 'msg' => 'Berhasil hapus data Urunan User !']);
    }
}
