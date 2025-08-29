@if(session('success') || session('error'))
    <div id="toast" class="fixed top-5 right-5 bg-white border-l-4 shadow-lg rounded-xl p-5 flex items-center gap-4 z-50 max-w-sm transition-all duration-300 {{ session('success') ? 'border-green-500' : 'border-red-500' }}">

        <div class="w-10 h-10 flex items-center justify-center rounded-full
            {{ session('success') ? 'bg-green-100' : 'bg-red-100' }}">
            <i class="fas {{ session('success') ? 'fa-check text-green-600' : 'fa-times text-red-600' }} text-lg"></i>
        </div>

        <div class="flex-1">
            <p class="text-base font-semibold text-slate-800">
                {{ session('success') ? 'Berhasil' : 'Gagal' }}
            </p>
            <p class="text-sm text-slate-600">
                {{ session('success') ?? session('error') }}
            </p>
        </div>

        <button onclick="document.getElementById('toast').remove()"
            class="ml-2 text-slate-400 hover:text-slate-600 text-lg">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toast = document.getElementById("toast");
            if (toast) {
                setTimeout(() => {
                    toast.classList.add("opacity-0", "translate-x-5");
                    setTimeout(() => toast.remove(), 300);
                }, 3700);
            }
        });
    </script>
@endif
