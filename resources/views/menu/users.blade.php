@extends('layouts.adminlte')

@section('content')
    <h4>Daftar pengguna WebApti:</h4>
    <a href="{{ route('usersManagementAddView') }}" class="btn btn-primary">Tambah</a>
    <a href="{{ route('resetQuota') }}" class="btn btn-danger">Reset kuota</a><br>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Jabatan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
        @foreach ($users as $key => $value)
            <tr>
                <th>{{ $users->firstItem() + $key }}</th>
                <td>{{ $value->nip }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>
                    @if ($value->is_admin)
                        Administrator
                    @else
                        Pengguna
                    @endif
                </td>
                <td>{{ $value->position }}</td>
                <td>{{ $value->address }}</td>
                <td>{{ $value->telp }}</td>
                @if ($value->id == Auth::user()->id)
                    <td>Tidak ada aksi</td>
                @else
                    <td style="display: flex">
                        <a href="{{ route('usersManagementEditView', $value->id) }}" class="btn btn-primary"><i class="fa fa-edit"> Ubah</i></a>
                        <form onsubmit="return confirm('Apakah Anda yakin?');"
                            action="{{ route('usersManagementDelete', $value->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"> Hapus</i></button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection
