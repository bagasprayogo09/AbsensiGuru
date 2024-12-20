<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        img {
            max-width: 90%; /* Agar gambar responsif */
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Absensi</h1>
    <p>Periode: {{ $start_date }} s/d {{ $end_date }}</p>
    <table>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th> <!-- Kolom Jam Masuk -->
            <th>Jam Keluar</th> <!-- Kolom Jam Keluar -->
            <th>Status</th>
            <th>Foto Jam Keluar</th>
        </tr>
        @foreach($absensis as $item)
        <tr>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->tanggal }}</td>
            <td>{{ $item->jam_masuk }}</td> <!-- Menampilkan Jam Masuk -->
            <td>{{ $item->jam_keluar }}</td> <!-- Menampilkan Jam Keluar -->
            <td>{{ $item->status }}</td>
            <td>
                @if($item->foto_jam_keluar)
                    <img src="{{ asset('storage/' . $item->foto_jam_keluar) }}" alt="Foto Jam Keluar">
                @else
                    Tidak ada foto
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
