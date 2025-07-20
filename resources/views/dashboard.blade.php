<x-app-layout title="Dashboard">
    <style>
        :root {
            --primary: #3B82F6;
            --primary-light: #DBEAFE;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --purple: #8B5CF6;
        }

        .dark {
            --primary: #60A5FA;
            --primary-light: #1E3A8A;
            --success: #34D399;
            --warning: #FBBF24;
            --danger: #F87171;
            --purple: #A78BFA;
        }

        .dark .bg-white {
            background-color: #1F2937;
        }

        .dark .text-gray-800 {
            color: #D1D5DB;
        }

        .dark .text-gray-600 {
            color: #9CA3AF;
        }

        .dark .border-gray-200 {
            border-color: #374151;
        }

        .dark .bg-gray-50 {
            background-color: #374151;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease-in-out;
        }
    </style>

    <!-- Header with Dark Mode Toggle -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Dashboard</h1>
        <button id="theme-toggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700">
            <i class="fas fa-moon text-gray-600 dark:text-gray-300"></i>
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Siswa</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalStudents) }}</p>
                    <p
                        class="text-sm {{ $studentGrowth >= 0 ? 'text-green-600' : 'text-red-600' }} flex items-center mt-1">
                        <i class="fas {{ $studentGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs($studentGrowth) }}% dari bulan lalu
                    </p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Guru</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalTeachers) }}</p>
                    <p class="text-sm text-blue-600 dark:text-blue-400 flex items-center mt-1">
                        <i class="fas fa-equals mr-1"></i>
                        Semua Mapel
                    </p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kelas Aktif</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($activeClasses) }}</p>
                    <p class="text-sm text-purple-600 dark:text-purple-400 flex items-center mt-1">
                        <i class="fas fa-check mr-1"></i>
                        Sedang berjalan
                    </p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-full">
                    <i class="fas fa-door-open text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Rata-rata Nilai</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($averageGrade, 1) }}
                    </p>
                    <p class="text-sm text-green-600 dark:text-green-400 flex items-center mt-1">
                        <i class="fas fa-chart-line mr-1"></i>
                        Data terkini
                    </p>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                    <i class="fas fa-star text-yellow-600 dark:text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Performance Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Performa Akademik</h3>
                <select id="performanceFilter"
                    class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-3 py-1 text-sm text-gray-800 dark:text-gray-200">
                    <option value="6">6 Bulan Terakhir</option>
                    <option value="12">1 Tahun Terakhir</option>
                </select>
            </div>
            <div class="h-80">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>

        <!-- Class Distribution -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Distribusi Siswa per Kelas</h3>
            <div class="h-80">
                <canvas id="classChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activities -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Aktivitas Terbaru</h3>
                    <a href="#"
                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">Lihat
                        Semua</a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentActivities as $activity)
                        <div class="flex items-start space-x-3">
                            <div
                                class="bg-{{ $activity['color'] }}-100 dark:bg-{{ $activity['color'] }}-900 p-2 rounded-full">
                                <i
                                    class="{{ $activity['icon'] }} text-{{ $activity['color'] }}-600 dark:text-{{ $activity['color'] }}-400 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $activity['title'] }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $activity['description'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <i class="fas fa-inbox text-4xl mb-2"></i>
                            <p>Belum ada aktivitas terbaru</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions and Calendar -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Aksi Cepat & Jadwal</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <a href="{{ route('students.create') }}"
                        class="flex flex-col items-center p-4 bg-blue-50 dark:bg-blue-900 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-lg transition-colors card-hover">
                        <i class="fas fa-plus text-blue-600 dark:text-blue-400 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-blue-600 dark:text-blue-400">Tambah Siswa</span>
                    </a>

                    <a href="{{ route('grades.create') }}"
                        class="flex flex-col items-center p-4 bg-green-50 dark:bg-green-900 hover:bg-green-100 dark:hover:bg-green-800 rounded-lg transition-colors card-hover">
                        <i class="fas fa-file-import text-green-600 dark:text-green-400 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-green-600 dark:text-green-400">Input Nilai</span>
                    </a>

                    <a href="{{ route('schedules.create') }}"
                        class="flex flex-col items-center p-4 bg-purple-50 dark:bg-purple-900 hover:bg-purple-100 dark:hover:bg-purple-800 rounded-lg transition-colors card-hover">
                        <i class="fas fa-calendar-plus text-purple-600 dark:text-purple-400 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-purple-600 dark:text-purple-400">Buat Jadwal</span>
                    </a>

                    <button onclick="window.print()"
                        class="flex flex-col items-center p-4 bg-yellow-50 dark:bg-yellow-900 hover:bg-yellow-100 dark:hover:bg-yellow-800 rounded-lg transition-colors card-hover">
                        <i class="fas fa-print text-yellow-600 dark:text-yellow-400 text-2xl mb-2"></i>
                        <span class="text-sm font-medium text-yellow-600 dark:text-yellow-400">Cetak Laporan</span>
                    </button>
                </div>

                <!-- Calendar Widget -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Jadwal Hari Ini
                        ({{ now()->format('l') }})</h4>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="text-center mb-4">
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ now()->format('d') }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ now()->format('F Y - l') }}</p>
                        </div>
                        <div class="space-y-2 max-h-48 overflow-y-auto">
                            @forelse($todaySchedule as $schedule)
                                <div
                                    class="flex items-start space-x-2 text-sm bg-white dark:bg-gray-800 p-2 rounded card-hover">
                                    <i class="fas fa-clock text-blue-600 dark:text-blue-400 mt-1"></i>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800 dark:text-gray-200">
                                            {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                        </div>
                                        <div class="text-gray-600 dark:text-gray-400">
                                            {{ $schedule->subject->name }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $schedule->teacher->name }} • {{ $schedule->classroom }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 dark:text-gray-400 text-sm py-4">
                                    <i class="fas fa-calendar-times text-2xl mb-2"></i>
                                    <p>Tidak ada jadwal hari ini</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js and Dark Mode Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dark Mode Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
            themeToggle.innerHTML = html.classList.contains('dark') ?
                '<i class="fas fa-sun text-gray-300"></i>' :
                '<i class="fas fa-moon text-gray-600"></i>';
        });

        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            html.classList.add('dark');
            themeToggle.innerHTML = '<i class="fas fa-sun text-gray-300"></i>';
        }

        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        let performanceChart = new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($performanceData, 'month')) !!},
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: {!! json_encode(array_column($performanceData, 'grade')) !!},
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
                        max: 100,
                        grid: {
                            color: html.classList.contains('dark') ? '#374151' : '#E5E7EB'
                        }
                    },
                    x: {
                        grid: {
                            color: html.classList.contains('dark') ? '#374151' : '#E5E7EB'
                        }
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
        // Class Distribution Chart
        const classCtx = document.getElementById('classChart').getContext('2d');
        const classChart = new Chart(classCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($classDistribution->pluck('class_name')) !!}, // Changed from 'class' to 'class_name'
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
                        position: 'bottom',
                        labels: {
                            color: html.classList.contains('dark') ? '#D1D5DB' : '#1F2937'
                        }
                    }
                }
            }
        });

        // Performance Filter Handler
        document.getElementById('performanceFilter').addEventListener('change', async (e) => {
            const months = e.target.value;
            // Here you would typically make an AJAX call to fetch new data
            // For now, we'll just update the chart with existing data
            performanceChart.data.labels = {!! json_encode(array_column($performanceData, 'month')) !!};
            performanceChart.data.datasets[0].data = {!! json_encode(array_column($performanceData, 'grade')) !!};
            performanceChart.update();
        });
    </script>
</x-app-layout>
