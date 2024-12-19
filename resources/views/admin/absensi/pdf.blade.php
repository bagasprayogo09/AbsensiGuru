<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Absensi</h1>
    <p>Periode: {{ $start_date }} s/d {{ $end_date }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $item->jam_masuk }}</td>
                    <td>{{ $item->jam_keluar }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>
                        @if($item->foto_jam_keluar)
                        <img src="{{ public_path('storage/' . $item->foto_jam_keluar) }}" alt="Foto">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
