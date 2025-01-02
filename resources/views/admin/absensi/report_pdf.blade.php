<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #000;
            padding: 5px;
        }
        .statistik {
            margin-bottom: 20px;
        }
        .statistik table {
            width: 100%;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
        }
        .img-small {
            width: 150px;
            height: auto;
        }

    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ABSENSI</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($start_date)->format('d F Y') }}
           s/d {{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</p>
    </div>

    <div class="statistik">
        <table>
            <thead>
                <tr>
                    <th>Total Absensi</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alfa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $statistik['total'] }}</td>
                    <td>{{ $statistik['hadir'] }}</td>
                    <td>{{ $statistik['izin'] }}</td>
                    <td>{{ $statistik['sakit'] }}</td>
                    <td>{{ $statistik['alfa'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Foto Jam Keluar</th>

            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $index => $absensi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $absensi->guru->name ?? 'Tidak Diketahui' }}</td>
                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d F Y') }}</td>
                <td>{{ ucfirst($absensi->status) }}</td>
                <td>{{ $absensi->keterangan ?? '-' }}</td>
                <td>
                @if ($absensi->foto_keluar)
                <img src="{{ asset('storage/' . $absensi->foto_keluar) }}" alt="Foto Jam Keluar" class="img-small">
                @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
