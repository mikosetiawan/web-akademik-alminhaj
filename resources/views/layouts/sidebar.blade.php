<!-- Sidebar -->
<div class="w-64 bg-white shadow-lg">
    <!-- Logo -->
    <div class="p-6 border-b">
        <div class="flex items-center space-x-3">
            <div class="bg-white p-2 rounded-lg">
                {{-- <i class="fas fa-graduation-cap text-white text-xl"></i> --}}
                <img src="{{ asset('assets/img/alminhaj.png') }}" alt="" style="width: 45px;">
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-800">MTS Al-Minhaj</h1>
                <p class="text-sm text-gray-600">Cilegon</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-6">
        <div class="px-6 mb-6">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'font-medium' : '' }}">
                        <i class="fas fa-home w-5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('students.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('students.*') ? 'font-medium' : '' }}">
                        <i class="fas fa-users w-5"></i>
                        <span>Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('teachers.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('teachers.*') ? 'font-medium' : '' }}">
                        <i class="fas fa-chalkboard-teacher w-5"></i>
                        <span>Data Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('attendances.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('attendances.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('attendances.*') ? 'font-medium' : '' }}">
                        <i class="fas fa-clipboard-check w-5"></i>
                        <span>Data Absensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subjects.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('subjects.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('subjects.*') ? 'font-medium' : '' }}">
                        <i class="fas fa-book w-5"></i>
                        <span>Data Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('schedules.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('schedules.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('schedules.*') ? 'font-medium' : '' }}">
                        <i class="fas fa-calendar-alt w-5"></i>
                        <span>Jadwal Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('grades.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('grades.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('grades.*') ? 'font-medium' : '' }}">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Data Nilai</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Profile Section -->
        <div class="px-6 mb-6">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Profil</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg transition-colors {{ request()->routeIs('profile.*') ? 'font-medium' : '' }}">
                        <i class="fas fa-user-cog w-5"></i>
                        <span>Pengaturan Profil</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</div>
