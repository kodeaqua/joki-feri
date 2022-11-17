@extends('layouts.adminlte')

@section('content')
    @if (Auth::user()->quota > 0)
        @if (session('success'))
            <div class="text-center text-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="text-center text-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('breakRequestSend') }}">
            @csrf
            <label for="nip">NIP:</label><br>
            <input type="text" id="nip" name="nip" placeholder="{{ Auth::user()->nip }}"
                value="{{ Auth::user()->nip }}" readonly disabled><br>
            <label for="name">Nama lengkap:</label><br>
            <input type="text" id="name" name="name" placeholder="{{ Auth::user()->name }}"
                value="{{ Auth::user()->name }}" readonly disabled><br>
            <label for="reason">Perihal:</label><br>
            <select id="reason" name="reason">
                <option value="Sakit">Sakit</option>
                <option value="Izin">Izin</option>
                <option value="Lainnya">Lainnya</option>
            </select><br>
            <label for="description">Deskripsi:</label></br>
            <textarea id="description" name="description" cols="64" rows="4"></textarea><br>
            <label for="break_start">Mulai cuti:</label><br>
            <input type="date" id="break_start" name="break_start"><br>
            <label for="duration">Lama cuti (Sisa kuota cuti anda: {{ Auth::user()->quota }} hari)</label><br>
            <input type="number" id="duration" name="duration"><br>
            <br>
            <p class="text-red">* Selain cuti sakit, maka kuota cuti akan terpotong</p>
            <button type="submit">Ajukan</button><br>
        </form>
    @else
        <h4>Anda tidak memiliki kesempatan cuti lagi tahun ini!</h4>
    @endif
@endsection
