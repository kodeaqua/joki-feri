<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: legal
        }
    </style>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script>
        window.print()
    </script>
</head>

<body class="legal">
    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <!-- Write HTML just like a web page -->
        <article class="d-flex flex-column align-items-start">
            <div class="d-flex flex-column align-self-end align-items-center">
                <p></br>Bogor, {{ date('d M Y') }}</p>
            </div>
            <div class="text-start">
                <p>Perihal &nbsp; &nbsp; &nbsp; : Permohonan Cuti {{ $breakrequest->reason }}</p>
                <br><br>
                <p>Kepada Yth.</p>
                <p>Kepala Badan Pertanahan Nasional Kota Bogor</p>
                <p>Di tempat</p>
                <br><br>
                <p>Yang bertanda tangan di bawah ini:</p>
                <p>Nama &nbsp; &nbsp; &nbsp; : {{ $breakrequest->user->name }}</p>
                <p>NIP &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : {{ $breakrequest->user->nip }}</p>
                <p>Jabatan &nbsp; &nbsp; : {{ $breakrequest->user->position }}</p>
                <p>Divisi &nbsp; &nbsp; &nbsp; &nbsp; : Tata usaha</p>
                <p>Bermaksud mengajukan cuti mulai tanggal {{ date('d F Y', strtotime($breakrequest->break_start)) }}
                    sampai dengan tanggal
                    {{ date('d F Y', strtotime($breakrequest->break_start . ' + ' . $breakrequest->duration . ' days')) }}.
                    Demikian surat
                    permohonan cuti ini. Atas perhatiannya saya ucapkan terima kasih.</p>
                <br><br>
                <p>Hormat saya,</p>
                <br><br><br><br>
                <p>{{ $breakrequest->user->name }}</p>
            </div>


        </article>

    </section>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
