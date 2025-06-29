<x-app-layout title="Detail">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                    <p class="text-3xl font-bold text-gray-900">487</p>
                    <p class="text-sm text-green-600 flex items-center mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        12% dari bulan lalu
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Guru</p>
                    <p class="text-3xl font-bold text-gray-900">45</p>
                    <p class="text-sm text-blue-600 flex items-center mt-1">
                        <i class="fas fa-equals mr-1"></i>
                        Stabil
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Kelas Aktif</p>
                    <p class="text-3xl font-bold text-gray-900">18</p>
                    <p class="text-sm text-purple-600 flex items-center mt-1">
                        <i class="fas fa-check mr-1"></i>
                        Semua berjalan
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-door-open text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Rata-rata Nilai</p>
                    <p class="text-3xl font-bold text-gray-900">8.2</p>
                    <p class="text-sm text-green-600 flex items-center mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        0.3 poin naik
                    </p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-star text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Performance Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Performa Akademik</h3>
                <select class="bg-gray-50 border border-gray-300 rounded px-3 py-1 text-sm">
                    <option>6 Bulan Terakhir</option>
                    <option>1 Tahun Terakhir</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="performanceChart" width="400" height="300"></canvas>
            </div>
        </div>

        <!-- Class Distribution -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Siswa per Kelas</h3>
            <div class="h-64">
                <canvas id="classChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activities -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat
                        Semua</a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded-full">
                            <i class="fas fa-file-alt text-blue-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Pengumpulan Nilai UTS</p>
                            <p class="text-sm text-gray-600">Guru Matematika telah mengumpulkan nilai UTS
                                kelas 8A</p>
                            <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="bg-green-100 p-2 rounded-full">
                            <i class="fas fa-user-plus text-green-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Siswa Baru Terdaftar</p>
                            <p class="text-sm text-gray-600">Ahmad Fadhil telah mendaftar sebagai siswa
                                baru kelas 7C</p>
                            <p class="text-xs text-gray-500 mt-1">4 jam yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="bg-yellow-100 p-2 rounded-full">
                            <i class="fas fa-calendar text-yellow-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Jadwal Ujian Diperbaharui</p>
                            <p class="text-sm text-gray-600">Jadwal UAS semester genap telah diperbaharui
                            </p>
                            <p class="text-xs text-gray-500 mt-1">1 hari yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="bg-purple-100 p-2 rounded-full">
                            <i class="fas fa-trophy text-purple-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Prestasi Siswa</p>
                            <p class="text-sm text-gray-600">Kelas 9A menjadi juara 1 lomba cerdas cermat
                                tingkat kota</p>
                            <p class="text-xs text-gray-500 mt-1">2 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Aksi Cepat</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                        <i class="fas fa-plus text-blue-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-blue-600">Tambah Siswa</span>
                    </button>

                    <button
                        class="flex flex-col items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <i class="fas fa-file-import text-green-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-green-600">Import Nilai</span>
                    </button>

                    <button
                        class="flex flex-col items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                        <i class="fas fa-calendar-plus text-purple-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-purple-600">Buat Jadwal</span>
                    </button>

                    <button
                        class="flex flex-col items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition-colors">
                        <i class="fas fa-print text-yellow-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-yellow-600">Cetak Rapor</span>
                    </button>
                </div>

                <!-- Calendar Widget -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800 mb-3">Agenda Hari Ini</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-center mb-4">
                            <p class="text-2xl font-bold text-gray-800">28</p>
                            <p class="text-sm text-gray-600">Juni 2025 - Sabtu</p>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2 text-sm">
                                <i class="fas fa-clock text-blue-600"></i>
                                <span class="text-gray-600">14:00 - Rapat Guru</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm">
                                <i class="fas fa-book text-green-600"></i>
                                <span class="text-gray-600">16:00 - Bimbingan Siswa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
