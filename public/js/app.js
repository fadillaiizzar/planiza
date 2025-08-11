        // Existing functions
        function toggleSidebarSize() {
            const sidebar = document.getElementById('sidebar');
            const isCollapsed = sidebar.classList.toggle('w-20');
            sidebar.classList.toggle('w-64', !isCollapsed);
            const profileSection = document.getElementById('profileSection');
            const userName = document.getElementById('userName');
            if (isCollapsed) {
                profileSection.classList.replace('gap-3', 'gap-2');
                userName.classList.add('opacity-0', 'w-0', 'overflow-hidden');
            } else {
                profileSection.classList.replace('gap-2', 'gap-3');
                userName.classList.remove('opacity-0', 'w-0', 'overflow-hidden');
            }
            document.querySelectorAll('.sidebar-label').forEach(label => {
                label.classList.toggle('opacity-0', isCollapsed);
                label.classList.toggle('w-0', isCollapsed);
                label.classList.toggle('overflow-hidden', isCollapsed);
            });
            document.querySelectorAll('.icon-wrapper').forEach(wrapper => {
                wrapper.classList.toggle('justify-center', isCollapsed);
                wrapper.classList.toggle('justify-start', !isCollapsed);
            });
            const icon = document.getElementById('sidebarToggleIcon');
            icon.classList.toggle('fa-angle-left', !isCollapsed);
            icon.classList.toggle('fa-angle-right', isCollapsed);
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const isOpen = sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        function toggleDropdown(id) {
            // Tutup semua dropdown dulu
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el.id !== `dropdown-${id}`) el.classList.add('hidden');
            });
            // Toggle dropdown yang diklik
            const dropdown = document.getElementById(`dropdown-${id}`);
            dropdown.classList.toggle('hidden');
        }
