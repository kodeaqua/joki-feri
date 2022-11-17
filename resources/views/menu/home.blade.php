@extends('layouts.adminlte')

@section('content')
    <h4>Batas pengajuan anda tahun ini: {{ Auth::user()->quota }}</h4>
    <h4>Pengajuan cuti terakhir:</h4>
    @if (isset($latest))
        <table class="table table-bordered">
            <tr>
                <th>Diajukan pada</th>
                <th>Perihal</th>
                <th>Deskripsi</th>
                <th>Mulai</th>
                <th>Lama</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <tr>
                <td>{{ $latest->created_at }}</td>
                <td>{{ $latest->reason }}</td>
                <td>{{ $latest->description }}</td>
                <td>{{ $latest->break_start }}</td>
                <td>{{ $latest->duration }} hari</td>
                <td>
                    @if ($latest->status)
                        Diterima
                    @else
                        Menunggu
                    @endif
                </td>
                <td>
                    @if ($latest->status == true)
                        <a class="btn btn-primary" href="{{ route('breaksManagementPrint', $latest->id) }}">Cetak</a>
                    @else
                        <p>Tidak ada aksi</p>
                    @endif
                </td>
            </tr>
        </table>
    @else
        <h4 class="text-center text-success">Belum ada pengajuan cuti</h4>
    @endif
    <h4>Riwayat cuti anda:</h4><br>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Diajukan pada</th>
            <th>Perihal</th>
            <th>Deskripsi</th>
            <th>Mulai</th>
            <th>Lama</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach ($breakrequestrecord as $key => $value)
            <tr>
                <td>{{ $breakrequestrecord->firstItem() + $key }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->reason }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->break_start }}</td>
                <td>{{ $value->duration }} hari</td>
                <td>
                    @if ($latest->status)
                        Diterima
                    @else
                        Menunggu
                    @endif
                </td>
                <td>
                    @if ($latest->status == true)
                        <a class="btn btn-primary" href="{{ route('breaksManagementPrint', $latest->id) }}">Cetak</a>
                    @else
                        <p>Tidak ada aksi</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $breakrequestrecord->links() }}
@endsection
