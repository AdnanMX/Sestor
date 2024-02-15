<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengguna</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0 0;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .total-section {
            margin-top: 20px;
            text-align: left;
        }

        h3 {
            margin: 1px 0;
        }
    </style>
</head>

<body>
    <h1>Daftar Pengguna</h1>
    <hr>
    <span>Tanggal Cetak: {{ date('d/m/Y') }}</span><br>
    <span>Waktu Cetak: {{ date('H:i:s') }}</span>
    <br>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        @php
        $roleCounts = [
        'admin' => 0,
        'owner' => 0,
        'kasir' => 0,
        ];
        $totalUsers = 0;
        @endphp
        @forelse ($User as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->role }}</td>
        </tr>
        @php
        $roleCounts[$user->role]++;
        $totalUsers++;
        @endphp
        @empty
        <tr>
            <td colspan="4">User Tidak Ditemukan</td>
        </tr>
        @endforelse
    </table>
    <div class="total-section">
        <h3>Ringkasan</h3>
        <span>Total Pengguna: {{ $totalUsers }}</span><br>
        <span>Admin: {{ $roleCounts['admin'] }}</span><br>
        <span>Owner: {{ $roleCounts['owner'] }}</span><br>
        <span>Kasir: {{ $roleCounts['kasir'] }}</span>
    </div>
</body>

</html>