@extends('layouts.main')

@section('content')
    <x-create-button href="/urunan/create">Tambah Data Urunan</x-create-button>

    <input placeholder="Search . . ." class="mb-2" id="search">

    <div class="table-responsive mb-2">
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>nominal_dibutuhkan</th>
                    <th>nominal_per_orang</th>
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
        let url = '/urunan';

        const fetchData = async (page, custom = []) => {
            const {
                search
            } = custom;
            try {
                const res = await axios.get(`${url}?js=true&page=${page}&search=${search || ''}`)

                if (res.data && res.data.urunan) {
                    let urunan = res.data.urunan;

                    let data = urunan.data.map((u, index) => {
                        return `<tr>
                            <td>${res.data.urunan.from ++}</td>
                            <td>${u.nama}</td>
                            <td>${u.nominal_dibutuhkan}</td>
                            <td>${u.nominal_per_orang}</td>
                            <td class="text-center">
                                <a href="${url}/${u.id}" class="fa mx-1 fa-eye text-info"></a>
                                <a href="${url}/${u.id}/edit" class="fa mx-1 fa-edit text-success"></a>
                                <span type="button" class="fa mx-1 fa-trash text-danger" onclick="handleDelete('${url}', ${u.id}, '{{ csrf_token() }}')"></span>
                            </td>
                        </tr>`
                    })
                    document.querySelector('tbody').innerHTML = data.join('')

                    Pagination(res.data.urunan)
                    setTd()
                }
            } catch (err) {
                console.error(err.response);
            }
        }

        fetchData(1);
    </script>
@endsection
