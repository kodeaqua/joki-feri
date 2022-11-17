@extends('layouts.adminlte')

@section('content')
    @if (session('success'))
        <div class="text-center text-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="text-center text-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('usersManagementUpdate', $user->id) }}">
        @csrf
        @method('PUT')

        <label for="nip">NIP:</label><br>
        <input type="text" id="nip" name="nip" placeholder="{{ $user->nip }}"><br>

        <label for="name">Nama lengkap:</label><br>
        <input type="text" id="name" name="name" placeholder="{{ $user->name }}"><br>

        <label for="email">Alamat email:</label><br>
        <input type="email" id="email" name="email" placeholder="{{ $user->email }}"><br>

        <label for="password">Kata sandi:</label><br>
        <input type="password" id="password" name="password" placeholder="********"><br>

        <label for="position">Jabatan:</label><br>
        <input type="text" id="position" name="position" placeholder="{{ $user->position }}"><br>

        <label for="address">Alamat:</label><br>
        <input type="text" id="address" name="address" placeholder="{{ $user->address }}"><br>

        <label for="telp">Telepon</label><br>
        <input type="text" id="telp" name="telp" placeholder="{{ $user->telp }}"><br>

        <input type="checkbox" id="is_admin" name="is_admin"
            @if ($user->is_admin) checked value="true" @else value="false" @endif>
        <label for="is_admin">Administrator</label><br>

        <button class="btn btn-primary" type="submit">Simpan</button><br>
    </form>
@endsection
