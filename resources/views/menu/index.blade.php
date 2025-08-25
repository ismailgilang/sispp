<x-app-layout>
    @if (Auth::user()->role === 'admin')
        <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
            <!-- Header Welcome -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, <span class="text-indigo-600">{{ Auth::user()->name }}</span></h1>
                <p class="mt-2 text-gray-600">Dashboard Admin Sistem Informasi Pembayaran SPP</p>
                <div class="mt-4 w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full"></div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Card 1 - Total Siswa -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-b-4 border-indigo-400">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Siswa</h3>
                            <p class="text-2xl font-semibold text-gray-800">{{$siswa}}</p>
                            <p class="text-xs text-gray-400 mt-1">Siswa terdaftar</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 - Total Kelas -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-b-4 border-teal-400">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-teal-50 text-teal-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Kelas</h3>
                            <p class="text-2xl font-semibold text-gray-800">{{$kelas}}</p>
                            <p class="text-xs text-gray-400 mt-1">Kelas aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 - SPP Belum Dibayar -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-b-4 border-amber-400">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">SPP Belum Dibayar</h3>
                            <p class="text-2xl font-semibold text-gray-800">Rp {{ number_format($totalBelum, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{$bulanSekarang}} {{$tahunSekarang}}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 - SPP Masuk -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-b-4 border-emerald-400">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">SPP Masuk</h3>
                            <p class="text-2xl font-semibold text-gray-800">Rp {{ number_format($totalLunas, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{$bulanSekarang}} {{$tahunSekarang}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Activities -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Aktivitas Terkini</h2>
                        <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">Updated Today</span>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Activity 1 -->
                        <div class="flex items-start pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                            <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-800">Jumlah Siswa Saat ini</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $siswa }} Siswa & Siswi terdaftar</p>
                                <span class="inline-block mt-2 text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded-full">Total</span>
                            </div>
                        </div>
                        
                        <!-- Activity 2 -->
                        <div class="flex items-start pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                            <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-800">Siswa baru terdaftar</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $siswaSekarang }} Siswa baru tahun ini</p>
                                <span class="inline-block mt-2 text-xs px-2 py-1 bg-green-50 text-green-600 rounded-full">New</span>
                            </div>
                        </div>
                        
                        <!-- Activity 3 -->
                        <div class="flex items-start pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                            <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-800">Siswa Belum Membayar SPP</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $sppbelum }} Siswa belum melunasi</p>
                                <span class="inline-block mt-2 text-xs px-2 py-1 bg-yellow-50 text-yellow-600 rounded-full">Pending</span>
                            </div>
                        </div>
                        
                        <!-- Activity 4 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-800">Siswa Sudah Membayar SPP</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $spplunas }} Siswa telah melunasi</p>
                                <span class="inline-block mt-2 text-xs px-2 py-1 bg-purple-50 text-purple-600 rounded-full">Completed</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Aksi Cepat</h2>
                    <div class="grid grid-cols-2 gap-5">
                        <!-- Add Student -->
                        <a href="{{ route('Siswa.index') }}" class="group p-5 rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 hover:from-indigo-100 hover:to-blue-100 transition-all text-center border border-indigo-100">
                            <div class="mx-auto h-12 w-12 text-indigo-600 group-hover:text-indigo-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-gray-800 group-hover:text-indigo-700">Tambah Siswa</p>
                        </a>
                        
                        <!-- Add User -->
                        <a href="{{ route('Users.index') }}" class="group p-5 rounded-xl bg-gradient-to-br from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 transition-all text-center border border-blue-100">
                            <div class="mx-auto h-12 w-12 text-blue-600 group-hover:text-blue-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-gray-800 group-hover:text-blue-700">Tambah Users</p>
                        </a>
                        
                        <!-- Create Major -->
                        <a href="{{ route('Jurusan.index') }}" class="group p-5 rounded-xl bg-gradient-to-br from-teal-50 to-emerald-50 hover:from-teal-100 hover:to-emerald-100 transition-all text-center border border-teal-100">
                            <div class="mx-auto h-12 w-12 text-teal-600 group-hover:text-teal-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-gray-800 group-hover:text-teal-700">Buat Jurusan</p>
                        </a>
                        
                        <!-- Create Class -->
                        <a href="{{ route('Kelas.index') }}" class="group p-5 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 hover:from-amber-100 hover:to-yellow-100 transition-all text-center border border-amber-100">
                            <div class="mx-auto h-12 w-12 text-amber-600 group-hover:text-amber-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-gray-800 group-hover:text-amber-700">Buat Kelas</p>
                        </a>
                        
                        <!-- View SPP -->
                        <a href="{{ route('Pembayaran.index') }}" class="group p-5 rounded-xl bg-gradient-to-br from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 transition-all text-center border border-purple-100">
                            <div class="mx-auto h-12 w-12 text-purple-600 group-hover:text-purple-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-gray-800 group-hover:text-purple-700">Lihat SPP</p>
                        </a>
                        
                        <!-- SPP Billing -->
                        <a href="{{ route('Spp.index') }}" class="group p-5 rounded-xl bg-gradient-to-br from-rose-50 to-pink-50 hover:from-rose-100 hover:to-pink-100 transition-all text-center border border-rose-100">
                            <div class="mx-auto h-12 w-12 text-rose-600 group-hover:text-rose-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-gray-800 group-hover:text-rose-700">Tagihan SPP</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @if (Auth::user()->role === 'siswa')
        <div class="py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen">
            <!-- Header Welcome -->
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Selamat Datang, <span class="text-indigo-600">{{ Auth::user()->name }}</span></h1>
                <p class="text-lg text-gray-600 mb-6">Dashboard Siswa Sistem Informasi Pembayaran SPP</p>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-400 to-blue-400 rounded-full mx-auto"></div>
            </div>
            
            <!-- Student Dashboard Content -->
            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Student Info Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-indigo-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Informasi Siswa</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Nama Lengkap</h3>
                                <p class="text-lg font-semibold text-gray-800">{{   Auth::user()->name  }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">NISN</h3>
                                <p class="text-lg font-semibold text-gray-800">{{   Auth::user()->nis  }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Kelas</h3>
                                <p class="text-lg font-semibold text-gray-800">{{   Auth::user()->siswa->kelas->nama_kelas  }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- SPP Status Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-indigo-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Status SPP</h2>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Status Pembayaran Bulan Ini</h3>
                            <div class="flex items-center gap-2">
                                @foreach ($tagihanList2 as $tagihan2)
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800">{{ $tagihan2->status }}</span>
                                    <p class="text-sm text-green-600">
                                        Lunas untuk bulan {{ \Carbon\Carbon::parse($tagihan2->created_at)->translatedFormat('F Y') }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Total Tagihan</h3>
                            <p class="text-2xl font-bold text-gray-800">
                                {{ $totalTagihan > 0 ? 'Rp. ' . number_format($totalTagihan, 0, ',', '.') : 'Tidak ada tagihan' }}
                            </p>
                            @foreach ($tagihanList as $tagihan)
                                <p class="text-xs text-gray-500 mt-1">
                                    Per bulan {{ $tagihan->bulan }} {{ $tagihan->tahun }}
                                </p>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>