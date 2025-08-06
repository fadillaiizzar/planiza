<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Daftar Akun</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Data User -->
        <input type="text" name="name" placeholder="Nama" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

        <!-- Role -->
        <select name="role_id" id="roleSelect" required>
            <option value="">Pilih Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
            @endforeach
        </select>

        <!-- Form Tambahan Jika Role = Siswa -->
        <div id="siswaFields" style="display: none;">
            <select name="kelas_id">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>

            <select name="jurusan_id">
                <option value="">Pilih Jurusan</option>
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>

            <select name="rencana_id">
                <option value="">-- Kosongkan jika belum ada --</option>
                @foreach($rencanas as $rencana)
                    <option value="{{ $rencana->id }}">{{ $rencana->nama_rencana }}</option>
                @endforeach
            </select>

            <input type="text" name="no_hp" placeholder="No HP (boleh dikosongi)">
        </div>

        <button type="submit">Register</button>
    </form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('roleSelect');
        const siswaFields = document.getElementById('siswaFields');

        roleSelect.addEventListener('change', function () {
            const selectedText = this.options[this.selectedIndex].text;

            if (selectedText === 'Siswa') {
                siswaFields.style.display = 'block';
            } else {
                siswaFields.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
