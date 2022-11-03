<?php

namespace App\Http\Controllers;

use App\Models\Urunan;
use Illuminate\Http\Request;

class UrunanController extends Controller
{
    public function index(Request $req)
    {
        if ($req->js) {
            $urunan = Urunan::select('*')
                ->when($req->search, function ($query) use ($req) {
                    return $query->where(function ($query) use ($req) {
                        return $query->where('nama', 'like', "%$req->search%")
                            ->orWhere('nominal_dibutuhkan', 'like', "%$req->search%")
                            ->orWhere('nominal_per_orang', 'like', "%$req->search%");
                    });
                })
                ->paginate(env('PAGINATION'));

            return response()->json(compact('urunan'));
        }

        $title = 'Data Urunan';

        return view('urunan.urunan', compact('title'));
    }

    public function create()
    {
        $title = 'Tambah Data Urunan';

        return view('urunan.create', compact('title'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'nama' => 'required',
            'nominal_dibutuhkan' => 'required',
            'nominal_per_orang' => 'required',
        ]);

        Urunan::create($data);

        return redirect('/urunan')->with('success', 'Berhasil tambah data Urunan !');
    }

    public function show(Urunan $urunan)
    {
        $title = 'Lihat Data Urunan';

        return view('urunan.show', compact('title', 'urunan'));
    }

    public function edit(Urunan $urunan)
    {
        $title = 'Ubah Data Urunan';

        return view('urunan.edit', compact('title', 'urunan'));
    }

    public function update(Request $req, Urunan $urunan)
    {
        $data = $req->validate([
            'nama' => 'required',
            'nominal_dibutuhkan' => 'required',
            'nominal_per_orang' => 'required',
        ]);

        $urunan->update($data);

        return redirect('/urunan')->with('success', 'Berhasil ubah data Urunan !');
    }

    public function destroy($id)
    {
        Urunan::destroy($id);

        return response()->json(['status' => 'success', 'msg' => 'Berhasil hapus data Urunan !']);
    }
}
