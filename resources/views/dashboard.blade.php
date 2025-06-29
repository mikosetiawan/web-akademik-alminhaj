<x-app-layout title="Dashboard">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalStudents) }}</p>
                    <p class="text-sm {{ $studentGrowth >= 0 ? 'text-green-600' : 'text-red-600' }} flex items-center mt-1">
                        <i class="fas {{ $studentGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs($studentGrowth) }}% dari bulan lalu
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
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalTeachers) }}</p>
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
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($activeClasses) }}</p>
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
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($averageGrade, 1) }}</p>
                    <p class="text-sm text-green-600 flex items-center mt-1">
                        <i class="fas fa-chart-line mr-1"></i>
                        Data terkini
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
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentActivities as $activity)
                        <div class="flex items-start space-x-3">
                            <div class="bg-{{ $activity['color'] }}-100 p-2 rounded-full">
                                <i class="{{ $activity['icon'] }} text-{{ $activity['color'] }}-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $activity['title'] }}</p>
                                <p class="text-sm text-gray-600">{{ $activity['description'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2"></i>
                            <p>Belum ada aktivitas terbaru</p>
                        </div>
                    @endforelse
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
                    <a href="{{ route('students.create') }}"
                        class="flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                        <i class="fas fa-plus text-blue-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-blue-600">Tambah Siswa</span>
                    </a>

                    <a href="{{ route('grades.create') }}"
                        class="flex flex-col items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <i class="fas fa-file-import text-green-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-green-600">Input Nilai</span>
                    </a>

                    <a href="{{ route('schedules.create') }}"
                        class="flex flex-col items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                        <i class="fas fa-calendar-plus text-purple-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-purple-600">Buat Jadwal</span>
                    </a>

                    <button onclick="window.print()"
                        class="flex flex-col items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition-colors">
                        <i class="fas fa-print text-yellow-600 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-yellow-600">Cetak Laporan</span>
                    </button>
                </div>

                <!-- Calendar Widget -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800 mb-3">Jadwal Hari Ini</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-center mb-4">
                            <p class="text-2xl font-bold text-gray-800">{{ now()->format('d') }}</p>
                            <p class="text-sm text-gray-600">{{ now()->format('F Y - l') }}</p>
                        </div>
                        <div class="space-y-2">
                            @forelse($todaySchedule as $schedule)
                                <div class="flex items-center space-x-2 text-sm">
                                    <i class="fas fa-clock text-blue-600"></i>
                                    <span class="text-gray-600">
                                        {{ $schedule->start_time }} - {{ $schedule->class }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 text-sm">
                                    <i class="fas fa-calendar-times mb-1"></i>
                                    <p>Tidak ada jadwal hari ini</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($performanceData->pluck('month')) !!},
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: {!! json_encode($performanceData->pluck('grade')) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Class Distribution Chart
        const classCtx = document.getElementById('classChart').getContext('2d');
        const classChart = new Chart(classCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($classDistribution->pluck('class_name')) !!},
                datasets: [{
                    data: {!! json_encode($classDistribution->pluck('student_count')) !!},
                    backgroundColor: [
                        '#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', 
                        '#EF4444', '#06B6D4', '#84CC16', '#F97316'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>