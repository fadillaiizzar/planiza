function toggleStatusDropdown(id) {
    const el = document.getElementById(`status-dropdown-${id}`);
    el.classList.toggle('hidden');

    // Tutup dropdown lain
    document.querySelectorAll('[id^="status-dropdown-"]').forEach(d => {
        if (d.id !== `status-dropdown-${id}`) d.classList.add('hidden');
    });
}

// Klik di luar dropdown → close semua
document.addEventListener('click', function(e) {
    if (!e.target.closest('[id^="status-dropdown-"]') && !e.target.closest('button')) {
        document.querySelectorAll('[id^="status-dropdown-"]').forEach(d => d.classList.add('hidden'));
    }
});
