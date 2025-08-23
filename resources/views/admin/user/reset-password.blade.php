<div class="mt-6 p-5 bg-gray-50 border border-slate-200 rounded-2xl space-y-5">
    <h3 class="text-base font-semibold text-slate-700">Reset Password</h3>

    <form action="{{ route('admin.user.reset-password', $detailUser->id) }}" method="POST">
        @csrf
        <input type="hidden" name="reset_type" value="default">

        </button>
    </form>

    <!-- Reset custom password -->
    <form action="{{ route('admin.user.reset-password', $detailUser->id) }}" method="POST" class="space-y-3">
        @csrf
        <input type="hidden" name="reset_type" value="custom">

        <div class="space-y-1">
            <label for="password" class="block text-sm font-semibold text-slate-700">Password Baru</label>
            <input type="password" name="password" id="password" placeholder="Masukkan password baru"
                   class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
        </div>

        <div class="space-y-1">
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password baru"
                   class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
        </div>

        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-sm font-semibold text-white rounded-xl hover:bg-green-700 transition">
            Reset Password
        </button>
    </form>
</div>
