<?php

namespace App\Http\Controllers;

use App\Models\Upacara;
use Illuminate\Http\Request;

class UpacaraController extends Controller
{
    public function index(Request $req)
    {
        if ($req->js) {
            $upacara = Upacara::select('*')
                ->when($req->search, function ($query) use ($req) {
                    return $query->where(function ($query) use ($req) {
                        return $query->where('nama', 'like', "%$req->nama%")
                            ->orWhere('tanggal_mulai', 'like', "%$req->tanggal_mulai%")
                            ->orWhere('tanggal_selesai', 'like', "%$req->tanggal_selesai%")
                            ->orWhere('total_dp', 'like', "%$req->total_dp%")
                            ->orWhere('total_kas_keluar', 'like', "%$req->total_uang_keluar%")
                            ->orWhere('total_sesari', 'like', "%$req->total_sesari%")
                            ->orWhere('keterangan', 'like', "%$req->keterangan%");
                    });
                })
                ->paginate(env('PAGINATION'));

            return response()->json(compact('upacara'));
        }

        $title = 'Data upacara';

        return view('upacara.upacara', compact('title'));
    }

    public function create()
    {
        $title = 'Tambah Data Upacara';

        return view('upacara.create', compact('title'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'nullable',
            'total_sesari' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        Upacara::create($data);

        return redirect('/upacara')->with('success', 'Berhasil tambah data Upacara !');
    }

    public function show(Upacara $upacara)
    {
        $title = 'Lihat Data Upacara';

        return view('upacara.show', compact('title', 'upacara'));
    }

    public function edit(Upacara $upacara)
    {
        $title = 'Ubah Data Upacara';

        return view('upacara.edit', compact('title', 'upacara'));
    }

    public function update(Request $req, Upacara $upacara)
    {
        $data = $req->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'nullable',
            'total_sesari' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $upacara->update($data);

        return redirect('/upacara')->with('success', 'Berhasil ubah data Upacara !');
    }

    public function destroy($id)
    {
        Upacara::destroy($id);

        return response()->json(['status' => 'success', 'msg' => 'Berhasil hapus data Upacara !']);
    }
}
