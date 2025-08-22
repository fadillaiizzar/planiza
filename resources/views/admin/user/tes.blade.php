detail.blade

@extends('layouts.admin')

@section('title', 'Detail User - Planiza')

@section('content')
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
        <div class="mb-8 max-w-4xl mx-auto">
            <!-- Breadcrumb Guide -->
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('admin.user') }}"
                   class="group flex items-center px-4 py-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/70 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2 text-slate-300 group-hover:text-slate-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    <span class="font-medium">Users</span>
                </a>

                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <div class="flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-slate-600 to-slate-700 text-white shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="font-semibold">Detail User</span>
                </div>
            </nav>
        </div>

        @if(session('success'))
            <div class="mb-6 max-w-4xl mx-auto">
                <div class="px-6 py-4 bg-green-100 border border-green-200 text-green-800 rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Card Detail -->
        <div class="w-full max-w-4xl mx-auto text-left bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-8 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                    <!-- Profile Section -->
                    <div class="flex flex-col md:flex-row md:items-center md:space-x-3 text-left space-y-3 md:space-y-0 items-start">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Detail User</h2>
                            <p class="text-slate-200 text-sm">Informasi lengkap pengguna sistem</p>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <button
                        id="editToggleBtn"
                        type="button"
                        class="flex items-center justify-start py-2 px-4 bg-white/20 hover:bg-white/30 text-white rounded-xl transition-all duration-200 font-medium self-start md:self-center"
                        aria-label="Edit User"
                        title="Edit User"
                    >
                        <svg class="w-4 h-4 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span class="inline ml-2 md:ml-0">Edit</span>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="editForm">
                @csrf
                @method('PATCH')

                <div class="px-8 pt-8 pb-0 space-y-5">
                    <!-- Nama -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Nama
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $user->name) }}"
                            disabled
                            class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm
                            focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                            disabled:bg-slate-50 disabled:text-slate-600
                            @error('name') border-red-500 @enderror"
                        />
                        @error('name')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            Username
                        </label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username', $user->username) }}"
                            disabled
                            class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm
                            focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                            disabled:bg-slate-50 disabled:text-slate-600
                            @error('username') border-red-500 @enderror"
                        />
                        @error('username')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Role
                        </label>
                        <select
                            name="role_id"
                            id="role_id"
                            onchange="toggleSiswaFields()"
                            disabled
                            class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm
                            focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                            disabled:bg-slate-50 disabled:text-slate-600
                            @error('role_id') border-red-500 @enderror"
                        >
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if(old('role_id', $user->role_id) == $role->id) selected @endif>{{ $role->nama_role }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Password
                        </label>
                        <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-slate-50 shadow-sm">
                            ****
                        </div>
                        <div class="mt-2">
                            <button
                                id="resetPasswordBtn"
                                type="button"
                                onclick="showResetPasswordModal()"
                                class="text-gray-400 cursor-not-allowed text-sm font-medium flex items-center"
                                disabled
                            >
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Reset Password
                            </button>
                        </div>
                    </div>

                    <!-- Siswa Fields -->
                    <div id="siswaFields" style="display:none;" class="space-y-5 border-t border-slate-200 pt-5">
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                Informasi Siswa
                            </h3>
                        </div>

                        <!-- Kelas -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Kelas
                            </label>
                            <select
                                name="kelas_id"
                                id="kelas_id"
                                disabled
                                class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm
                                focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                                disabled:bg-slate-50 disabled:text-slate-600
                                @error('kelas_id') border-red-500 @enderror"
                            >
                                <option value="">-- Pilih Kelas --</option>
                                @foreach(\App\Models\Kelas::all() as $kelas)
                                    <option value="{{ $kelas->id }}" @if(old('kelas_id', $siswa->kelas_id ?? '') == $kelas->id) selected @endif>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Jurusan -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                                <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                                Jurusan
                            </label>
                            <select
                                name="jurusan_id"
                                id="jurusan_id"
                                disabled
                                class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm
                                focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                                disabled:bg-slate-50 disabled:text-slate-600
                                @error('jurusan_id') border-red-500 @enderror"
                            >
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach(\App\Models\Jurusan::all() as $jurusan)
                                    <option value="{{ $jurusan->id }}" @if(old('jurusan_id', $siswa->jurusan_id ?? '') == $jurusan->id) selected @endif>{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Rencana -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                                <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                Rencana
                            </label>
                            <select
                                name="rencana_id"
                                id="rencana_id"
                                disabled
                                class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm
                                focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                                disabled:bg-slate-50 disabled:text-slate-600
                                @error('rencana_id') border-red-500 @enderror"
                            >
                                <option value="">-- Pilih Rencana --</option>
                                @foreach(\App\Models\Rencana::all() as $rencana)
                                    <option value="{{ $rencana->id }}" @if(old('rencana_id', $siswa->rencana_id ?? '') == $rencana->id) selected @endif>{{ $rencana->nama_rencana }}</option>
                                @endforeach
                            </select>
                            @error('rencana_id')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center text-left justify-start">
                                <svg class="w-4 h-4 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                No HP
                            </label>
                            <input
                                type="text"
                                name="no_hp"
                                id="no_hp"
                                value="{{ old('no_hp', $siswa->no_hp ?? '') }}"
                                disabled
                                class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm
                                focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                                disabled:bg-slate-50 disabled:text-slate-600
                                @error('no_hp') border-red-500 @enderror"
                            />
                            @error('no_hp')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-slate-500">
                            <span class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Terakhir diperbarui: {{ $user->updated_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <div class="flex space-x-3">
                            <button
                                type="submit"
                                id="saveBtn"
                                class="hidden px-6 py-3 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white font-semibold rounded-xl transition-all duration-200 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 shadow-lg"
                            >
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan
                            </button>
                            <button
                                type="button"
                                id="cancelBtn"
                                class="hidden px-6 py-3 border border-slate-300 rounded-xl text-slate-700 hover:bg-slate-50 transition-all duration-200 font-medium"
                            >
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    {{-- Modal Reset Password --}}
    <div id="resetPasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-3xl shadow-2xl w-96 border border-slate-100">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-yellow-100 rounded-2xl flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Reset Password</h3>
            </div>

            {{-- Opsi Reset Password --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-3">Pilih Metode Reset</label>
                <select id="resetType" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-slate-500 focus:border-slate-500" onchange="toggleCustomPassword()">
                    <option value="default">Default Password (12345678)</option>
                    <option value="custom">Custom Password</option>
                </select>
            </div>

            <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST">
                @csrf

                {{-- Field Custom Password --}}
                <div id="customPasswordFields" class="hidden space-y-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password Baru</label>
                        <input type="password" name="password" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-slate-500 focus:border-slate-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-slate-500 focus:border-slate-500">
                    </div>
                </div>

                {{-- Hidden input untuk kirim tipe reset --}}
                <input type="hidden" name="reset_type" id="reset_type_input" value="default">

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('resetPasswordModal').classList.add('hidden')" class="px-6 py-3 text-slate-600 hover:text-slate-800 font-medium transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleSiswaFields() {
            const role = document.getElementById('role_id');
            const siswaFields = document.getElementById('siswaFields');
            if (role.options[role.selectedIndex].text.toLowerCase() === 'siswa') {
                siswaFields.style.display = 'block';
            } else {
                siswaFields.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleSiswaFields();
        });

        // --- Edit mode toggle ---
        const editToggleBtn = document.getElementById('editToggleBtn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const form = document.getElementById('editForm');

        editToggleBtn.addEventListener('click', () => {
            setEditMode(true);
        });

        cancelBtn.addEventListener('click', () => {
            window.location.reload();
        });

        function setEditMode(isEdit) {
            // Semua input, select, textarea
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach((input) => {
                if (input.type !== 'submit' && input.type !== 'button') {
                    input.disabled = !isEdit;
                }
            });

            // Tombol reset password
            const resetBtn = document.getElementById('resetPasswordBtn');
            if (resetBtn) {
                resetBtn.disabled = !isEdit;

                if (isEdit) {
                    resetBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
                    resetBtn.classList.add('text-blue-600', 'hover:text-blue-800', 'hover:underline');
                } else {
                    resetBtn.classList.add('text-gray-400', 'cursor-not-allowed');
                    resetBtn.classList.remove('text-blue-600', 'hover:text-blue-800', 'hover:underline');
                }
            }

            // Toggle tombol simpan, batal, dan edit
            saveBtn.classList.toggle('hidden', !isEdit);
            cancelBtn.classList.toggle('hidden', !isEdit);
            editToggleBtn.classList.toggle('hidden', isEdit);
        }

        function showResetPasswordModal() {
            document.getElementById('resetPasswordModal').classList.remove('hidden');
        }

        function toggleCustomPassword() {
            const resetType = document.getElementById('resetType').value;
            const customFields = document.getElementById('customPasswordFields');
            const hiddenInput = document.getElementById('reset_type_input');

            if (resetType === 'custom') {
                customFields.classList.remove('hidden');
                hiddenInput.value = 'custom';
            } else {
                customFields.classList.add('hidden');
                hiddenInput.value = 'default';
            }
        }
    </script>
@endpush
