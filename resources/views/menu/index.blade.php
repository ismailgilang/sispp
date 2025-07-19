<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, <span class="text-blue-600">{{ Auth::user()->name }}</span></h1>
            <p class="mt-1 text-gray-600">Akses cepat ke semua fitur SISPP</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Siswa</h3>
                        <p class="text-2xl font-semibold text-gray-900">1,248</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Kelas</h3>
                        <p class="text-2xl font-semibold text-gray-900">32</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Kehadiran Hari Ini</h3>
                        <p class="text-2xl font-semibold text-gray-900">87%</p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Tugas Belum Dinilai</h3>
                        <p class="text-2xl font-semibold text-gray-900">14</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activities -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Aktivitas Terkini</h2>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start pb-4 border-b border-gray-200">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Pembaruan sistem v2.3.1</p>
                            <p class="text-sm text-gray-500">Sistem telah diperbarui dengan fitur laporan keuangan baru.</p>
                            <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start pb-4 border-b border-gray-200">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">5 siswa baru terdaftar</p>
                            <p class="text-sm text-gray-500">Siswa baru telah terdaftar di kelas X IPA 1.</p>
                            <p class="text-xs text-gray-400 mt-1">Kemarin, 15:32</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Deadline tugas matematika</p>
                            <p class="text-sm text-gray-500">Tugas bab trigonometri akan berakhir dalam 2 hari.</p>
                            <p class="text-xs text-gray-400 mt-1">Kemarin, 10:15</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="p-4 rounded-lg bg-blue-50 hover:bg-blue-100 text-center transition-colors">
                        <div class="mx-auto h-10 w-10 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-900">Tambah Siswa</p>
                    </a>
                    <a href="#" class="p-4 rounded-lg bg-green-50 hover:bg-green-100 text-center transition-colors">
                        <div class="mx-auto h-10 w-10 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-900">Buat Kelas</p>
                    </a>
                    <a href="#" class="p-4 rounded-lg bg-yellow-50 hover:bg-yellow-100 text-center transition-colors">
                        <div class="mx-auto h-10 w-10 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-900">Input Nilai</p>
                    </a>
                    <a href="#" class="p-4 rounded-lg bg-purple-50 hover:bg-purple-100 text-center transition-colors">
                        <div class="mx-auto h-10 w-10 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-900">Buat Laporan</p>
                    </a>
                    <a href="#" class="p-4 rounded-lg bg-red-50 hover:bg-red-100 text-center transition-colors">
                        <div class="mx-auto h-10 w-10 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-900">Pengumuman</p>
                    </a>
                    <a href="#" class="p-4 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-center transition-colors">
                        <div class="mx-auto h-10 w-10 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-900">Jadwal</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Kalender Akademik</h2>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 rounded-md">Hari Ini</button>
                    <button class="px-3 py-1 text-sm bg-blue-600 text-white hover:bg-blue-700 rounded-md">Bulan Ini</button>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-2 mb-2">
                <div class="text-center font-medium text-gray-500 text-sm">Min</div>
                <div class="text-center font-medium text-gray-500 text-sm">Sen</div>
                <div class="text-center font-medium text-gray-500 text-sm">Sel</div>
                <div class="text-center font-medium text-gray-500 text-sm">Rab</div>
                <div class="text-center font-medium text-gray-500 text-sm">Kam</div>
                <div class="text-center font-medium text-gray-500 text-sm">Jum</div>
                <div class="text-center font-medium text-gray-500 text-sm">Sab</div>
            </div>
            <div class="grid grid-cols-7 gap-2">
                <!-- Calendar days would be dynamically generated here -->
                <div class="h-12 flex items-center justify-center text-gray-400">29</div>
                <div class="h-12 flex items-center justify-center text-gray-400">30</div>
                <div class="h-12 flex items-center justify-center">1</div>
                <div class="h-12 flex items-center justify-center">2</div>
                <div class="h-12 flex items-center justify-center">3</div>
                <div class="h-12 flex items-center justify-center">4</div>
                <div class="h-12 flex items-center justify-center">5</div>
                <!-- More days... -->
                <div class="h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-full font-medium">6</div>
                <div class="h-12 flex items-center justify-center">7</div>
                <div class="h-12 flex items-center justify-center">8</div>
                <div class="h-12 flex items-center justify-center">9</div>
                <div class="h-12 flex items-center justify-center">10</div>
                <div class="h-12 flex items-center justify-center">11</div>
                <div class="h-12 flex items-center justify-center">12</div>
                <!-- More days... -->
                <div class="h-12 flex items-center justify-center">13</div>
                <div class="h-12 flex items-center justify-center">14</div>
                <div class="h-12 flex items-center justify-center">15</div>
                <div class="h-12 flex items-center justify-center">16</div>
                <div class="h-12 flex items-center justify-center bg-red-50 text-red-600 rounded-full font-medium">17</div>
                <div class="h-12 flex items-center justify-center">18</div>
                <div class="h-12 flex items-center justify-center">19</div>
                <!-- More days... -->
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center mb-2">
                    <div class="h-3 w-3 rounded-full bg-blue-500 mr-2"></div>
                    <span class="text-sm text-gray-600">Ujian Tengah Semester</span>
                </div>
                <div class="flex items-center">
                    <div class="h-3 w-3 rounded-full bg-red-500 mr-2"></div>
                    <span class="text-sm text-gray-600">Libur Nasional</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>