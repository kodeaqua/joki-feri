@extends('layouts.adminlte')

@section('content')
    @if (session('success'))
        <div class="text-center text-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="text-center text-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('usersManagementStore') }}">
        @csrf

        <label for="nip">NIP:</label><br>
        <input type="text" id="nip" name="nip" placeholder="Misal: 065119076"><br>

        <label for="name">Nama lengkap:</label><br>
        <input type="text" id="name" name="name" placeholder="Misal: Feri Fadilah"><br>

        <label for="email">Alamat email:</label><br>
        <input type="email" id="email" name="email" placeholder="Misal: feri.065119076@unpak.ac.id"><br>

        <label for="password">Kata sandi:</label><br>
        <input type="password" id="password" name="password" placeholder="********"><br>

        <label for="position">Jabatan:</label><br>
        <input type="text" id="position" name="position" placeholder="Misal: Kepala BPN"><br>

        <label for="address">Alamat:</label><br>
        <input type="text" id="address" name="address" placeholder="Misal: Jalan Bogor"><br>

        <label for="telp">Telepon</label><br>
        <input type="text" id="telp" name="telp" placeholder="Misal: 08123456789"><br>

        <input type="checkbox" id="is_admin" name="is_admin" value="true">
        <label for="is_admin">Administrator</label><br>

        <button class="btn btn-primary" type="submit">Simpan</button><br>
    </form>
@endsection
