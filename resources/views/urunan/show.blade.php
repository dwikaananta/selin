@extends('layouts.main')

@section('content')
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">nama</div>
        <div class="col-md-8">{{ $urunan->nama }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">nominal_dibutuhkan</div>
        <div class="col-md-8">{{ $urunan->nominal_dibutuhkan }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">nominal_per_orang</div>
        <div class="col-md-8">{{ $urunan->nominal_per_orang }}</div>
    </div>
    <div class="row mb-2 border-bottom">
        <div class="col-4 title">nominal_terkumpul</div>
        <div class="col-md-8">{{ $urunan->nominal_terkumpul }}</div>
    </div>

    <h4 class="text-center">Data Urunan User</h4>
    <x-create-button href="/urunan-user/create?urunan_id={{ $urunan->id }}">Tambah Urunan User
    </x-create-button>

    <div class="table-responsive mb-2">
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>user_id</th>
                    <th>nominal</th>
                    <th>tanggal</th>
                    <th>bars</th>
                </tr>
            </thead>
            <tbody id="urunan_user">
            </tbody>
        </table>
    </div>

    <x-form-save-button :submit="false"></x-form-save-button>
@endsection

@section('js')
    <script>
        let url = '/urunan-user';

        const fetchUrunan = async (page, custom = []) => {
            const {
                search
            } = custom;
            try {
                const res = await axios.get(
                    `${url}?js=true&page=${page}&urunan_id={{ $urunan->id }}&search=${search || ''}`
                )

                if (res.data && res.data.urunan_user) {
                    let urunan_user = res.data.urunan_user;
                    let users = res.data.users;

                    let data = urunan_user.map((uu, index) => {
                        return `<tr>
                            <td>${index + 1}</td>
                            <td>${users.filter(u => u.id == uu.user_id).map(u => u.nama)}</td>
                            <td>${uu.nominal}</td>
                            <td>${uu.tanggal}</td>
                            <td>
                                <a href="${url}/${uu.id}/edit?urunan_id=${uu.urunan_id}" class="fa mx-1 fa-edit text-success"></a>
                                <span type="button" class="fa mx-1 fa-trash-alt text-danger" onclick="handleDelete('${url}', ${uu.id}, '{{ csrf_token() }}', 'urunan_id={{ $urunan->id }}')"></span>
                            </td>
                        </tr>`
                    })
                    document.querySelector('#urunan_user').innerHTML = data.join('')

                    setTd()
                }
            } catch (err) {
                console.error(err.response);
            }
        }

        fetchUrunan(1);

        const fetchData = () => {
            window.location.reload();
        }
    </script>
@endsection
