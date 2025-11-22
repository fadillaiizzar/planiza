<!-- Badge Status -->


<!-- Tombol Aksi -->
<button onclick="toggleStatusDropdown({{ $item->id }})"
    class="ml-2 p-2 rounded-lg hover:bg-slate-100 focus:outline-none transition-all">
    <i class="fas fa-cog text-slate-600"></i>
</button>

<!-- Dropdown Status -->
<div id="status-dropdown-{{ $item->id }}"
    class="hidden absolute left-0 mt-2 bg-white border border-slate-200 rounded-lg shadow-xl z-20 min-w-[160px]">

    <!-- Pending -->
    <form action="{{ route('admin.sdgs.kontribusi-sdgs.update-status', $item->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="pending">
        <button class="w-full text-left px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-yellow-600 transition-colors">
            <i class="fas fa-clock w-5 h-5"></i> Pending
        </button>
    </form>

    <div class="border-t border-slate-200"></div>

    <!-- Approved -->
    <form action="{{ route('admin.sdgs.kontribusi-sdgs.update-status', $item->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="approved">
        <button class="w-full text-left px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors">
            <i class="fas fa-check-circle w-5 h-5"></i> Approved
        </button>
    </form>

    <div class="border-t border-slate-200"></div>

    <!-- Rejected -->
    <form action="{{ route('admin.sdgs.kontribusi-sdgs.update-status', $item->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="rejected">
        <button class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors">
            <i class="fas fa-times-circle w-5 h-5"></i> Rejected
        </button>
    </form>
</div>
