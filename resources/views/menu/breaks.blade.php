@extends('layouts.adminlte')

@section('content')
    <h4>Daftar pengguna WebApti:</h4><br>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Diajukan oleh</th>
            <th>Diajukan pada</th>
            <th>Perihal</th>
            <th>Deskripsi</th>
            <th>Mulai</th>
            <th>Lama</th>
            <th>Aksi</th>
        </tr>
        @foreach ($breakrequests as $key => $value)
            <tr>
                <td>{{ $breakrequests->firstItem() + $key }}</td>
                <td>{{ $value->user->name }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->reason }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->break_start }}</td>
                <td>{{ $value->duration }} hari</td>
                <td style="display: flex">
                    @if (!$value->status)
                        <a href="{{ route('breaksManagementAccept', $value->id) }}" class="btn btn-success">Terima</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('breaksManagementPrint', $value->id) }}">Cetak</a>
                    @endif
                    <form onsubmit="return confirm('Apakah Anda yakin?');"
                        action="{{ route('breaksManagementDelete', $value->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $breakrequests->links() }}
@endsection
