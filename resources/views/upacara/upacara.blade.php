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
                    <th>total_dana_punia</th>
                    <th>total_kas_keluar</th>
                    <th>total_sesari</th>
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
                            <td>${u.total_dana_punia}</td>
                            <td>${u.total_kas_keluar}</td>
                            <td>${u.total_sesari}</td>
                            <td class="text-center">
                                ${u.status == 1 ? `<a href="${url}/${u.id}?laporan=1" class="fa mx-1 fa-print text-info"></a>` : ''}
                                ${u.status == 1 ? '' : `<span type="button" onclick="handleUpdate(${u.id})" class="fa mx-1 fa-check"></span>`}
                                <a href="${url}/${u.id}" class="fa mx-1 fa-eye text-info"></a>
                                <a href="${url}/${u.id}/edit" class="fa mx-1 fa-edit text-success"></a>
                                <span type="button" class="fa mx-1 fa-trash text-danger" onclick="handleDelete('${url}', ${u.id}, '{{ csrf_token() }}')"></span>
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

        const handleUpdate = async (id) => {
            try {
                const res = await axios.patch(`${url}/${id}`, { status: 1 })
                if (res.data && res.data.msg) {
                    alert(res.data.msg);
                    fetchData();
                }
            } catch (err) {
                console.error(err.response);
            }
        }
    </script>
@endsection
