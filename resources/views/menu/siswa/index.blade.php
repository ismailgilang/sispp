<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Siswa</h1>
            <div class="mt-2 w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full"></div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h2 class="text-lg font-semibold text-gray-800">Tabel Siswa</h2>
                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                            <!-- Search Input -->
                            <div class="relative w-full sm:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="searchInput" placeholder="Cari siswa..." 
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       onkeyup="searchTable()">
                            </div>
                            
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-modal')" class="w-full sm:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Tambah Data
                            </x-primary-button>
                        </div>
                    </div>
                    
                    <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full divide-y divide-gray-200" id="userTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ibu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ayah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Handphone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat Pada</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($data as $user)
                                    <tr class="user-row hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 nis">{{ $user->nis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 nama">{{ $user->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 nama_ibu">{{ $user->nama_ibu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 nama_ayah">{{ $user->nama_ayah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 kelas">{{ $user->kelas->nama_kelas }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 alamat">{{ $user->alamat }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 telp">{{ $user->no_telp }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 created_at">{{ $user->created_at }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex gap-3 items-center justify-center w-full">
                                                <a href="{{ route('Edit.siswa', $user->nis) }}" 
                                                   class="flex items-center px-3 py-2 border border-yellow-500 bg-yellow-50 text-yellow-600 rounded-md text-sm hover:bg-yellow-100 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <x-danger-button 
                                                   x-data="" 
                                                   x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $user->nis }}')"
                                                   class="flex border-2 border-red-500 items-center px-3 py-1 text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </x-danger-button>
                                            </div>
                                        </td>
                                    </tr>
                                    <x-modal name="confirm-delete-{{ $user->nis }}" :show="false" maxWidth="sm">
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h2>
                                            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus siswa <b>{{ $user->nama }} dengan NIS {{ $user->nis }}</b>?</p>
                                            <div class="mt-6 flex justify-end space-x-3">
                                                <x-secondary-button 
                                                    type="button" 
                                                    @click="$dispatch('close-modal', 'confirm-delete-{{ $user->nis }}')">
                                                    Batal
                                                </x-secondary-button>
                                                <form method="POST" action="{{ route('Hapus.siswa', $user->nis) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button type="submit">Ya, Hapus</x-danger-button>
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-4 text-center text-gray-500">Tidak ada data Siswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="w-full flex justify-end mt-6">
                        <div class="flex items-center justify-center gap-2" id="paginationControls">
                            <button id="prevPage" class="p-1 border rounded-md hover:bg-indigo-500 hover:text-white disabled:opacity-50 disabled:hover:bg-white" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <div id="pageNumbers" class="flex space-x-1"></div>
                            <button id="nextPage" class="p-1 border rounded-md hover:bg-indigo-500 hover:text-white disabled:opacity-50 disabled:hover:bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add User Modal -->
    <x-modal name="add-modal" focusable>
        <form method="POST" action="{{ route('Siswa.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                <span class="text-indigo-600">Tambah Siswa Baru</span>
                <div class="w-12 h-1 bg-indigo-500 rounded-full mt-1"></div>
            </h2>
            
            <div class="space-y-4">
                <div>
                    <x-input-label for="nis" value="NIS" />
                    <x-text-input id="nis" name="nis" type="text" class="mt-1 block w-full" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                    <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="nama" value="Nama Lengkap" />
                    <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="nama_ibu" value="Nama Ibu" />
                    <x-text-input id="nama_ibu" name="nama_ibu" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('nama_ibu')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="nama_ayah" value="Nama Ayah" />
                    <x-text-input id="nama_ayah" name="nama_ayah" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('nama_ayah')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="id_kelas" value="Kelas" />
                    <select id="id_kelas" name="id_kelas" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('id_kelas')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="alamat" value="Alamat" />
                    <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="no_telp" value="No Handphone" />
                    <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>
                    <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <script>
        // Variabel global untuk pagination
        let currentPage = 1;
        const rowsPerPage = 5;
        let filteredRows = [];
        let allRows = Array.from(document.querySelectorAll('.user-row'));

        // Inisialisasi pagination saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            filteredRows = [...allRows];
            setupPagination();
        });

        // Fungsi untuk setup pagination
        function setupPagination() {
            const pageNumbersDiv = document.getElementById('pageNumbers');
            pageNumbersDiv.innerHTML = '';
            
            const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
            
            // Tampilkan maksimal 5 nomor halaman
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(pageCount, startPage + 4);
            
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }
            
            // Tombol Previous
            document.getElementById('prevPage').disabled = currentPage === 1;
            
            // Nomor halaman
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = `px-3 py-1 border rounded-md text-sm ${currentPage === i ? 'bg-indigo-500 text-white' : 'hover:bg-gray-100'}`;
                pageButton.onclick = () => goToPage(i);
                pageNumbersDiv.appendChild(pageButton);
            }
            
            // Tombol Next
            document.getElementById('nextPage').disabled = currentPage === pageCount;
            
            // Tampilkan rows untuk halaman saat ini
            displayRowsForCurrentPage();
        }

        // Fungsi untuk menampilkan rows sesuai halaman
        function displayRowsForCurrentPage() {
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;
            
            allRows.forEach(row => row.style.display = 'none');
            
            filteredRows.slice(startIndex, endIndex).forEach(row => {
                row.style.display = '';
            });
        }

        // Fungsi untuk pindah halaman
        function goToPage(page) {
            currentPage = page;
            setupPagination();
        }

        // Event listener untuk tombol next dan previous
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                goToPage(currentPage - 1);
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
            if (currentPage < pageCount) {
                goToPage(currentPage + 1);
            }
        });

        // Fungsi untuk search
        function searchTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            filteredRows = allRows.filter(row => {
                const nis = row.querySelector('.nis').textContent.toLowerCase();
                const nama = row.querySelector('.nama').textContent.toLowerCase();
                const namaIbu = row.querySelector('.nama_ibu').textContent.toLowerCase();
                const namaAyah = row.querySelector('.nama_ayah').textContent.toLowerCase();
                const kelas = row.querySelector('.kelas').textContent.toLowerCase();
                const alamat = row.querySelector('.alamat').textContent.toLowerCase();
                const telp = row.querySelector('.telp').textContent.toLowerCase();
                const createdAt = row.querySelector('.created_at').textContent.toLowerCase();
                
                return nis.includes(searchTerm) || 
                       nama.includes(searchTerm) || 
                       namaIbu.includes(searchTerm) || 
                       namaAyah.includes(searchTerm) || 
                       kelas.includes(searchTerm) || 
                       alamat.includes(searchTerm) ||
                       telp.includes(searchTerm) || 
                       createdAt.includes(searchTerm);
            });
            
            currentPage = 1;
            setupPagination();
        }
    </script>
</x-app-layout>