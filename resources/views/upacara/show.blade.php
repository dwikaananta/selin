@extends('layouts.main')

@section('content')
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">nama</div>
        <div class="col-md-8">: {{ $upacara->nama }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">tanggal_mulai</div>
        <div class="col-md-8">: {{ $upacara->tanggal_mulai }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">total_dana_punia</div>
        <div class="col-md-8">: {{ $upacara->total_dana_punia }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">keterangan</div>
        <div class="col-md-8">: {{ $upacara->keterangan }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">tanggal_selesai</div>
        <div class="col-md-8">: {{ $upacara->tanggal_selesai }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">total_kas_keluar</div>
        <div class="col-md-8">: {{ $upacara->total_kas_keluar }}</div>
    </div>
    <div class="row mb-5 border-bottom">
        <div class="col-4 title">total_sesari</div>
        <div class="col-md-8">: {{ $upacara->total_sesari }}</div>
    </div>

    <div class="row">
        <div class="col-6 border-end">
            <h4 class="text-center">Data Dana Punia</h4>
            @if (auth()->user()->status != 3)
                <x-create-button href="/dana-punia/create?upacara_id={{ $upacara->id }}">Tambah Dana Punia
                </x-create-button>
            @endif
        </div>
        <div class="col-6">
            <h4 class="text-center">Data Kas Keluar</h4>
            @if (auth()->user()->status != 3)
                <x-create-button href="/kas-keluar/create?upacara_id={{ $upacara->id }}">Tambah Kas Keluar
                </x-create-button>
            @endif
        </div>
        <div class="col-6 border-end">
            <div class="table-responsive mb-2">
                <table>
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>status</th>
                            <th>nama</th>
                            <th>alamat</th>
                            <th>no_hp</th>
                            <th>nominal</th>
                            <th>tanggal</th>
                            @if (auth()->user()->status != 3)
                                <th>bars</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="dana_punia">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div class="table-responsive mb-2">
                <table>
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>nama</th>
                            <th>nominal</th>
                            <th>tanggal</th>
                            <th>keterangan</th>
                            @if (auth()->user()->status != 3)
                                <th>bars</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="kas_keluar">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-form-save-button :submit="false"></x-form-save-button>
@endsection

@section('js')
    <script>
        let url_dana_punia = '/dana-punia';

        const fetchDataDanaPunia = async (page, custom = []) => {
            const {
                search
            } = custom;
            try {
                const res = await axios.get(
                    `${url_dana_punia}?js=true&page=${page}&upacara_id={{ $upacara->id }}&search=${search || ''}`
                )

                if (res.data && res.data.dana_punia) {
                    let dana_punia = res.data.dana_punia;
                    let users = res.data.users;

                    let data = dana_punia.map((dp, index) => {
                        return `<tr>
                            <td>${index + 1}</td>
                            <td>${dp.user_id ? '<span class="text-success">User Terdaftar</span>' : '<span class="text-info">User Tidak Terdaftar</span>'}</td>
                            <td>${dp.user_id ? users.filter(u => u.id == dp.user_id)[0]['nama'] : dp.nama}</td>
                            <td>${dp.user_id ? users.filter(u => u.id == dp.user_id)[0]['alamat'] : dp.alamat}</td>
                            <td>${dp.user_id ? users.filter(u => u.id == dp.user_id)[0]['no_hp'] : dp.no_hp}</td>
                            <td>${dp.nominal}</td>
                            <td>${dp.tanggal}</td>
                            @if (auth()->user()->status != 3)
                                <td>
                                    <a href="${url_dana_punia}/${dp.id}/edit?upacara_id=${dp.upacara_id}" class="fa mx-1 fa-edit text-success"></a>
                                    <span type="button" class="fa mx-1 fa-trash-alt text-danger" onclick="handleDelete('${url_dana_punia}', ${dp.id}, '{{ csrf_token() }}', 'upacara_id={{ $upacara->id }}')"></span>
                                </td>
                            @endif
                        </tr>`
                    })
                    document.querySelector('#dana_punia').innerHTML = data.join('')

                    setTd()
                }
            } catch (err) {
                console.error(err.response);
            }
        }

        let url_kas_keluar = '/kas-keluar';

        const fetchDataKasKeluar = async (page, custom = []) => {
            const {
                search
            } = custom;
            try {
                const res = await axios.get(
                    `${url_kas_keluar}?js=true&page=${page}&upacara_id={{ $upacara->id }}&search=${search || ''}`
                )

                if (res.data && res.data.kas_keluar) {
                    let kas_keluar = res.data.kas_keluar;

                    let data = kas_keluar.map((kk, index) => {
                        return `<tr>
                            <td>${index + 1}</td>
                            <td>${kk.nama}</td>
                            <td>${kk.nominal}</td>
                            <td>${kk.tanggal}</td>
                            <td>${kk.keterangan}</td>
                            @if (auth()->user()->status != 3)
                                <td>
                                    <a href="${url_kas_keluar}/${kk.id}/edit?upacara_id=${kk.upacara_id}" class="fa mx-1 fa-edit text-success"></a>
                                    <span type="button" class="fa mx-1 fa-trash-alt text-danger" onclick="handleDelete('${url_kas_keluar}', ${kk.id}, '{{ csrf_token() }}', 'upacara_id={{ $upacara->id }}')"></span>
                                </td>
                            @endif
                        </tr>`
                    })
                    document.querySelector('#kas_keluar').innerHTML = data.join('')

                    setTd()
                }
            } catch (err) {
                console.error(err.response);
            }
        }

        fetchDataDanaPunia(1);
        fetchDataKasKeluar(1);

        const fetchData = (page) => {
            window.location.reload();
        }
    </script>
@endsection
