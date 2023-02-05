<?php

namespace App\Http\Controllers;

use App\Models\DanaPunia;
use App\Models\Upacara;
use App\Models\User;
use Illuminate\Http\Request;

class DanaPuniaController extends Controller
{
    public $users;

    public function __construct()
    {
        $this->users = User::noAdmin()->orderBy('nama')->get();
    }

    public function index(Request $req)
    {
        if ($req->js) {
            $dana_punia = DanaPunia::select('*')
                ->where('upacara_id', $req->upacara_id)
                ->when($req->search, function ($query) use ($req) {
                    return $query->where(function ($query) use ($req) {
                        // search
                    });
                })
                ->get();

            $users = $this->users;

            return response()->json(compact('dana_punia', 'users'));
        } else {
            if ($req->laporan) {
                $dana_punia = DanaPunia::select('*')->with('user')
                    ->where('upacara_id', $req->upacara_id)
                    ->when($req->search, function ($query) use ($req) {
                        return $query->where(function ($query) use ($req) {
                            // search
                        });
                    })
                    ->get();

                $users = $this->users;

                return view('upacara.laporan-dana-punia', compact('dana_punia', 'users'));
            }
        }
    }

    public function create(Request $req)
    {
        $title = 'Tambah Data Dana Punia';
        $upacara_id = $req->upacara_id;
        $users = $this->users;

        return view('dana_punia.create', compact('title', 'upacara_id', 'users'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'upacara_id' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
        ]);

        if ($req->user_id) {
            $data_2 = $req->validate([
                'user_id' => 'required',
            ]);

            DanaPunia::create(array_merge($data, $data_2));
        } else {
            $data_2 = $req->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ]);

            DanaPunia::create(array_merge($data, $data_2));
        }

        // $this->total_dana_punia($req);

        return redirect("/upacara/$req->upacara_id")->with('success', 'Berhasil tambah data Dana Punia !');
    }

    public function show(DanaPunia $danaPunia)
    {
        //
    }

    public function edit($id, Request $req)
    {
        $title = 'Ubah Data Dana Punia';
        $dana_punia = DanaPunia::find($id);
        $upacara_id = $req->upacara_id;
        $users = $this->users;

        return view('dana_punia.edit', compact('title', 'dana_punia', 'upacara_id', 'users'));
    }

    public function update(Request $req, $id)
    {
        $dana_punia = DanaPunia::find($id);

        $data = $req->validate([
            'upacara_id' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
        ]);

        if ($req->user_id) {
            $data_2 = $req->validate([
                'user_id' => 'required',
            ]);

            $dana_punia->update(array_merge($data, $data_2));
        } else {
            $data_2 = $req->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ]);

            $dana_punia->update(array_merge($data, $data_2));
        }

        // $this->total_dana_punia($req);

        return redirect("/upacara/$req->upacara_id")->with('success', 'Berhasil ubah data Dana Punia !');
    }

    public function destroy($id, Request $req)
    {
        DanaPunia::destroy($id);

        // $this->total_dana_punia($req);

        return response()->json(['status' => 'success', 'msg' => 'Berhasil hapus data Dana Punia !']);
    }

    // function total_dana_punia($req)
    // {
    //     $upacara = Upacara::find($req->upacara_id);
    //     $total_dana_punia = DanaPunia::where('upacara_id', $req->upacara_id)->sum('nominal');
    //     $upacara->update([
    //         'total_dana_punia' => $total_dana_punia,
    //     ]);
    // }
}
