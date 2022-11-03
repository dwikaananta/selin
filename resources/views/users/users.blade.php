@extends('layouts.main')

@section('content')
    <x-create-button href="/users/create">Tambah Data User</x-create-button>

    <input placeholder="Search . . ." class="mb-2" id="search">

    <div class="table-responsive mb-2">
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>email</th>
                    <th>no_hp</th>
                    <th>jenis_kelamin</th>
                    <th>tempat_lahir</th>
                    <th>tanggal_lahir</th>
                    <th>kk</th>
                    <th>status_kk</th>
                    <th>status_user</th>
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
        let url = '/users';

        const fetchData = async (page, custom = []) => {
            const {
                search
            } = custom;
            try {
                const res = await axios.get(`${url}?js=true&page=${page}&search=${search || ''}`)

                if (res.data && res.data.users) {
                    let users = res.data.users;
                    let jenis_kelamin = res.data.jenis_kelamin;
                    let status_kk = res.data.status_kk;
                    let status_user = res.data.status_user;

                    let data = users.data.map((user, index) => {
                        return `<tr>
                            <td>${res.data.users.from ++}</td>
                            <td>${user.nama}</td>
                            <td>${user.email}</td>
                            <td>${user.no_hp}</td>
                            <td>${jenis_kelamin[user.jenis_kelamin]}</td>
                            <td>${user.tempat_lahir}</td>
                            <td>${user.tanggal_lahir}</td>
                            <td>${user.kk}</td>
                            <td>${status_kk[user.status_kk]}</td>
                            <td>${status_user[user.status]}</td>
                            <td>
                                <a href="${url}/${user.id}" class="fa mx-1 fa-eye text-info"></a>
                                <a href="${url}/${user.id}/edit" class="fa mx-1 fa-edit text-success"></a>
                                <span type="button" class="fa mx-1 fa-trash-alt text-danger" onclick="handleDelete('${url}', ${user.id}, '{{ csrf_token() }}')"></span>
                            </td>
                        </tr>`
                    })
                    document.querySelector('tbody').innerHTML = data.join('')

                    Pagination(res.data.users)
                    setTd()
                }
            } catch (err) {
                console.error(err.response);
            }
        }

        fetchData(1);
    </script>
@endsection
