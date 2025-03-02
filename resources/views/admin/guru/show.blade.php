<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-black">
            {{ __('Detail Guru') }}
        </h2>
    </x-slot>
    <div class="container">
        <h3>Detail Guru</h3>
        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $guru->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $guru->email }}</td>
            </tr>
            <tr>
                <th>Pendidikan Terakhir</th>
                <td>{{ $guru->pendidikan_terakhir }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $guru->alamat }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>{{ $guru->jurusan }}</td>
            </tr>
            <tr>
                <th>Password</th>
                <td>
                    <span id="passwordField">********</span>
                    <button onclick="togglePassword()" class="btn btn-sm btn-primary">Lihat</button>
                </td>
            </tr>
        </table>

        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <script>
        function togglePassword() {
            let passwordField = document.getElementById("passwordField");
            if (passwordField.innerText === "********") {
                passwordField.innerText = "{{ Crypt::decryptString($guru->password) }}"; // Dekripsi password
            } else {
                passwordField.innerText = "********";
            }
        }
    </script>
</x-app-layout>

