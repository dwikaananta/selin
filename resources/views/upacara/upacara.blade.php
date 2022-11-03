@extends('layouts.main')

@section('content')
    <x-create-button href="/upacara/create">Tambah Data Upacara</x-create-button>

    <input placeholder="Search . . ." class="mb-2" id="search">

    <div class="table-responsive mb-2">
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>tanggal_mulai</th>
                    <th>tanggal_selesai</th>
                    <th>total_dana_punia</th>
                    <th>total_kas_keluar</th>
                    <th>total_sesari</th>
                    <th>created_at</th>
                    <th>bars</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <nav id="pagination"></nav>
@endsection

@section('js')
    <script>
        let url = '/upacara';

        const fetchData = async (page, custom = []) => {
            const {
                search
            } = custom;
            try {
                const res = await axios.get(`${url}?js=true&page=${page}&search=${search || ''}`)

                if (res.data && res.data.upacara) {
                    let upacara = res.data.upacara;

                    let data = upacara.data.map((u, index) => {
                        return `<tr>
                            <td>${res.data.upacara.from ++}</td>
                            <td>${u.nama}</td>
                            <td>${u.tanggal_mulai}</td>
                            <td>${u.tanggal_selesai}</td>
                            <td>${u.total_dana_punia}</td>
                            <td>${u.total_kas_keluar}</td>
                            <td>${u.total_sesari}</td>
                            <td>${u.created_at}</td>
                            <td>
                                <a href="${url}/${u.id}" class="fa mx-1 fa-eye text-info"></a>
                                <a href="${url}/${u.id}/edit" class="fa mx-1 fa-edit text-success"></a>
                                <span type="button" class="fa mx-1 fa-trash-alt text-danger" onclick="handleDelete('${url}', ${u.id}, '{{ csrf_token() }}')"></span>
                            </td>
                        </tr>`
                    })
                    document.querySelector('tbody').innerHTML = data.join('')

                    Pagination(res.data.upacara)
                    setTd()
                }
            } catch (err) {
                console.error(err.response);
            }
        }

        fetchData(1);
    </script>
@endsection
