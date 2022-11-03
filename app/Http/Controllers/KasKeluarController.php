<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\Upacara;
use Illuminate\Http\Request;

class KasKeluarController extends Controller
{
    public function index(Request $req)
    {
        if ($req->js) {
            $kas_keluar = KasKeluar::select('*')
                ->where('upacara_id', $req->upacara_id)
                ->when($req->search, function ($query) use ($req) {
                    return $query->where(function ($query) use ($req) {
                        // search
                    });
                })
                ->get();

            return response()->json(compact('kas_keluar'));
        }
    }

    public function create(Request $req)
    {
        $title = 'Tambah Data Kas Keluar';
        $upacara_id = $req->upacara_id;

        return view('kas_keluar.create', compact('title', 'upacara_id'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'upacara_id' => 'required',
            'nama' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'nullable',
        ]);

        KasKeluar::create($data);

        $this->total_kas_keluar($req);

        return redirect("/upacara/$req->upacara_id")->with('success', 'Berhasil tambah data Kas Keluar !');
    }

    public function show(KasKeluar $kasKeluar)
    {
        //
    }

    public function edit($id, Request $req)
    {
        $title = 'Ubah Data Dana Punia';
        $kas_keluar = KasKeluar::find($id);
        $upacara_id = $req->upacara_id;

        return view('kas_keluar.edit', compact('title', 'kas_keluar', 'upacara_id'));
    }

    public function update(Request $req, $id)
    {
        $kas_keluar = KasKeluar::find($id);

        $data = $req->validate([
            'upacara_id' => 'required',
            'nama' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'nullable',
        ]);

        $kas_keluar->update($data);

        $this->total_kas_keluar($req);

        return redirect("/upacara/$req->upacara_id")->with('success', 'Berhasil ubah data Kas Keluar !');
    }

    public function destroy($id, Request $req)
    {
        KasKeluar::destroy($id);

        $this->total_kas_keluar($req);

        return response()->json(['status' => 'success', 'msg' => 'Berhasil hapus data Kas Keluar !']);
    }

    function total_kas_keluar($req)
    {
        $upacara = Upacara::find($req->upacara_id);
        $total_kas_keluar = KasKeluar::where('upacara_id', $req->upacara_id)->sum('nominal');
        $upacara->update([
            'total_kas_keluar' => $total_kas_keluar,
        ]);
    }
}
